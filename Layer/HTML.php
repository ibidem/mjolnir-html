<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Base
 * @author     Ibidem Team
 * @copyright  (c) 2012 Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class Layer_HTML extends \app\Layer
	implements
		\mjolnir\types\Params,
		\mjolnir\types\Document,
		\mjolnir\types\HTML
{
	use \app\Trait_Params;
	use \app\Trait_Document
		{
			\app\Trait_Document::body as document_body;
		}

	/**
	 * @var string
	 */
	protected static $layer_name = \mjolnir\types\HTML::LAYER_NAME;

	/**
	 * @var \mjolnir\types\ErrorView
	 */
	protected $errorview = null;

	/**
	 * @return \mjolnir\base\Layer_HTML
	 */
	static function instance()
	{
		$instance = parent::instance();
		$instance->params = \app\CFS::config('mjolnir/html');

		// register event handlers
		\app\GlobalEvent::listener('webpage:title', function ($title) use ($instance) {
			$instance->title($title);
		});

		\app\GlobalEvent::listener('webpage:description', function ($description) use ($instance) {
			$instance->description($description);
		});

		\app\GlobalEvent::listener('webpage:keywords', function (array $keywords) use ($instance) {
			$instance->keywords($keywords);
		});

		\app\GlobalEvent::listener('webpage:script', function ($src) use ($instance) {
			$instance->add_script($src);
		});

		\app\GlobalEvent::listener('webpage:head-script', function ($src) use ($instance) {
			$instance->add_head_script($src);
		});

		\app\GlobalEvent::listener('webpage:head-extra', function ($value) use ($instance) {
			$instance->add_extra_markup($value);
		});

		\app\GlobalEvent::listener('webpage:body-extra', function ($value) use ($instance) {
			$instance->add_footer_markup($value);
		});

		\app\GlobalEvent::listener('webpage:style', function ($src) use ($instance) {
			$instance->add_stylesheet($src);
		});

		\app\GlobalEvent::listener('webpage:humanstxt', function ($enabled) use ($instance) {
			$instance->humanstxt($enabled);
		});

		\app\GlobalEvent::listener('webpage:appcache', function ($url) use ($instance) {
			$instance->appcache($url);
		});

		\app\GlobalEvent::listener('webpage:atomfeed', function ($url) use ($instance) {
			$instance->atomfeed($url);
		});

		\app\GlobalEvent::listener('webpage:rssfeed', function ($url) use ($instance) {
			$instance->rssfeed($url);
		});

		\app\GlobalEvent::listener('webpage:canonical', function ($url) use ($instance) {
			$instance->canonical($url);
		});

		\app\GlobalEvent::listener('webpage:crawlers', function ($enabled) use ($instance) {
			$instance->crawlers($enabled);
		});

		\app\GlobalEvent::listener('webpage:errorview', function ($handler) use ($instance) {
			$instance->errorview($handler);
		});

		return $instance;
	}

	/**
	 * @return string
	 */
	protected function html_before()
	{
		$html_before = $this->params['doctype']."\n";
		// appcache manifest
		if ($this->params['appcache'] !== null)
		{
			$html_before .= '<html manifest="'.$this->params['appcache'].'">';
		}
		else # no appcache
		{
			$html_before .= '<html>';
		}
		// head section
		$html_before .= '<head>';
		// load base configuration
		$mjolnir_base = \app\CFS::config('mjolnir/base');

		# --- Relevant to the user experience -------------------------------- #

		// content type
		$html_before .= '<meta http-equiv="content-type" content="'
			. \app\Layer::find('http')->get_content_type()
			. '; charset='.$mjolnir_base['charset'].'">';
		// Make a DNS handshake with a foreign domain, so the connection goes
		// faster when the user eventually needs to access it.
		// eg. //ajax.googleapis.com
		foreach ($this->params['prefetch_domains'] as $prefetch_domain)
		{
			'<link rel="dns-prefetch" href="'.$prefetch_domain.'">';
		}
		// mobile viewport optimized: h5bp.com/viewport
		$html_before .= '<meta name="viewport" content="'.$this->params['viewport'].'">';
		// helps a little with compatibility; unnecesary \w .htaccess
		$html_before .= '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">';
		// standard favicon path
		if ($this->params['favicon'] === null)
		{
			$html_before .= '<link rel="shortcut icon" href="//'.$mjolnir_base['domain'].$mjolnir_base['path'].'favicon.ico" type="image/x-icon">';
		}
		else # predefined path
		{
			$html_before .= '<link rel="shortcut icon" href="'.$this->params['favicon'].'" type="image/x-icon">';
		}
		// title
		$html_before .= '<title>'.$this->params['title'].'</title>';
		// add fix for IE
		$html_before .= '<!--[if lt IE 9]><script src="//'.$mjolnir_base['domain'].$mjolnir_base['path'].'media/static/html5shiv.js"></script><![endif]-->';
		// stylesheets
		foreach ($this->params['stylesheets'] as $style)
		{
			$html_before .= '<link rel="stylesheet" type="'.$style['type'].'" href="'.$style['href'].'">';
		}
		// kill IE6's pop-up-on-mouseover toolbar for images
		$html_before .= '<meta http-equiv="imagetoolbar" content="no">';

		# --- Relevant to search engine results ------------------------------ #

		if ($this->params['description'] !== null)
		{
			// note: it is not guranteed search engines will use it; and they
			// won't if the content of the page is nonexistent, or this
			// description is not unique enough over multiple pages.
			$html_before .= '<meta name="description" content="'.$this->params['description'].'">';
		}

		// extra garbage: keywords, generator, author
		if ( ! empty($this->params['keywords']))
		{
			$keywords = '';
			foreach ($this->params['keywords'] as $keyword)
			{
				$keywords .= ' '.$keyword;
			}
			$html_before .= '<meta name="keywords" content="'.$keywords.'">';
		}
		if ($this->params['generator'] !== null)
		{
			$html_before .= '<meta name="generator" content="'.$this->params['generator'].'">';
		}
		if ($this->params['author'] !== null)
		{
			$html_before .= '<meta name="author" content="'.$this->params['author'].'">';
		}

		# --- Relevant to crawlers ------------------------------------------- #

		// A canonical route is the route by which search engines should
		// identify the current page; ragerdless of what the current url might
		// look like.
		if ($this->params['canonical'] !== null)
		{
			$html_before .= '<link rel="canonical" href="'.$this->params['canonical'].'">';
		}

		// sitemap, for search engines.
		// see: http://www.sitemaps.org/protocol.html
		if ($this->params['sitemap'] !== null)
		{
			$html_before .= '<link rel="sitemap" type="application/xml" title="Sitemap" href="'.$this->params['sitemap'].'">';
		}

		// block search engines from viewing the page
		if ($this->params['crawlers'])
		{
			$html_before .= '<meta name="robots" content="index, follow" />';
		}
		else # do not allow search engines
		{
			$html_before .= '<meta name="robots" content="noindex" />';
		}

		# --- Feed and callbacks --------------------------------------------- #

		// http://www.rssboard.org/rss-specification
		if ($this->params['rssfeed'] !== null)
		{
			$html_before .= '<link rel="alternate" type="application/rss+xml" title="RSS" href="'.$this->params['rssfeed'].'">';
		}

		// http://www.atomenabled.org/developers/syndication/
		if ($this->params['atomfeed'] !== null)
		{
			$html_before .= '<link rel="alternate" type="application/atom+xml" title="Atom" href="'.$this->params['atomfeed'].'">';
		}

		// http://codex.wordpress.org/Introduction_to_Blogging#Pingbacks
		if ($this->params['pingback'] !== null)
		{
			$html_before .= '<link rel="pingback" href="'.$this->params['pingback'].'">';
		}

		# --- Extras --------------------------------------------------------- #

		// see: http://humanstxt.org/
		if ($this->params['humanstxt'])
		{
			$html_before .= '<link type="text/plain" rel="author" href="'.$mjolnir_base['base_url'].'humans.txt">';
		}

		# Pin status (IE9 etc)

		// name to use when pinned
		if ($this->params['application_name'] !== null)
		{
			$html_before .= '<meta name="application-name" content="'.$this->params['application_name'].'">';
		}

		// tooltip to use when pinned
		if ($this->params['application_tooltip'] !== null)
		{
			$html_before .= '<meta name="msapplication-tooltip" content="'.$this->params['application_tooltip'].'">';
		}

		// page to go to when pinned
		if ($this->params['application_starturl'] !== null)
		{
			$html_before .= '<meta name="msapplication-starturl" content="'.$this->params['application_starturl'].'">';
		}

		if ( ! empty($this->params['scripts']))
		{
			// javascript loader
			$html_before .= '<script type="text/javascript" src="'.\app\CFS::config('mjolnir/html')['js-loader'].'"></script>';
		}

		$scripts = $this->params['head_scripts'];
		foreach ($scripts as $script)
		{
			$html_before .= '<script type="text/javascript" src="'.\addslashes($script).'"></script>';
		}

		if ( ! empty($this->params['extra_markup']))
		{
			foreach ($this->params['extra_markup'] as $markup)
			{
				$html_before .= $markup;
			}
		}

		// close head section
		$html_before .= '</head><body>';
		// css switch for more streamline style transitions
		if ($this->params['javascript_switch'])
		{
			$html_before .= '<script type="text/javascript">document.body.id = "javascript-enabled";</script>';
		}
		$html_before .= "\n\n";

		return $html_before;
	}

	/**
	 * Closing html.
	 *
	 * @return string
	 */
	protected function html_after()
	{
		$body = "\n\n";
		if ( ! empty($this->params['scripts']))
		{
			$body .= '<script type="text/javascript">yepnope({ load: [';
			$scripts = $this->params['scripts'];
			$body .= '\''.\addslashes(\array_shift($scripts)).'\'';
			foreach ($scripts as $script)
			{
				$body .= ', \''.\addslashes($script).'\'';
			}
			$body .= '] });</script>';
		}

		if ( ! empty($this->params['extra_footer_markup']))
		{
			foreach ($this->params['extra_footer_markup'] as $markup)
			{
				$body .= $markup;
			}
		}

		$body .= "</body></html>\n";

		return $body;
	}

	/**
	 * Execute the layer.
	 */
	function execute()
	{
		try
		{
			// execute sub layers
			parent::execute();
			// got sublayers?
			if ($this->layer !== null)
			{
				$layer_contents = $this->layer->get_contents();
				if ($layer_contents !== null)
				{
					$this->contents
						(
							static::html_before().
							$layer_contents.
							static::html_after()
						);
				}
				else # no layer contents
				{
					// we still output a valid html document; it's possible it's
					// just all javascript or something else, so there's no contents
					// becuase it's all dynamically generated
					$this->contents
						(
							static::html_before().
							static::html_after()
						);
				}
			}
			else # we've only got a body
			{
				// if we're a leaf layer, we use the body
				$this->contents
					(
						static::html_before().
						$this->get_body().
						static::html_after()
					);
			}
		}
		catch (\Exception $exception)
		{
			$this->exception($exception);
		}
	}

	/**
	 * Fills body and approprite calls for current layer, and passes the
	 * exception up to be processed by the layer above, if the layer has a
	 * parent.
	 *
	 * @param \Exception
	 */
	function exception(\Exception $exception, $no_throw = false, $origin = false)
	{
		if (\is_a($exception, '\mjolnir\types\Exception'))
		{
			$this->title($exception->title());
			$this->crawlers(false);

			if ($this->errorview !== null && ($content = $this->errorview->errorpage($exception)) !== null)
			{
				$this->contents
					(
						$this->html_before().
						$content.
						$this->html_after()
					);
			}
			else if ($this->layer !== null && ! $origin)
			{
				$this->contents
					(
						$this->html_before().
						$this->layer->get_contents().
						$this->html_after()
					);
			}
			else if ( ! $origin)
			{
				$this->contents
					(
						$this->html_before().
						$this->get_body().
						$this->html_after()
					);
			}
		}
		else # other type
		{
			if ($this->errorview !== null && ($content = $this->errorview->errorpage($exception)) !== null)
			{
				$this->contents
					(
						$this->html_before().
						$content.
						$this->html_after()
					);
			}
		}

		// default execution from Layer
		parent::exception($exception, $no_throw);
	}

	/**
	 * Sets the doctype. See: \mjolnir\types\HTML for constants.
	 *
	 * @param string doctype
	 * @return \mjolnir\base\Layer_HTML $this
	 */
	function doctype($doctype)
	{
		return $this->set('doctype', $doctype);
	}

	/**
	 * Appcache manifest location.
	 *
	 * @param string url
	 * @return \mjolnir\base\Layer_HTML $this
	 */
	function appcache($url = null)
	{
		return $this->set('appcache', $url);
	}

	/**
	 * Sitemap, be it index or simple sitemap.
	 *
	 * @param string url
	 * @return \mjolnir\base\Layer_HTML $this
	 */
	function sitemap($url = null)
	{
		return $this->set('sitemap', $url);
	}

	/**
	 * @param array domains
	 * @return \mjolnir\base\Layer_HTML $this
	 */
	function add_dns_prefetch_domains(array $domains)
	{
		foreach ($domains as $domain)
		{
			$this->params['prefetch_domains'][] = $domain;
		}

		return $this;
	}

	/**
	 * @param string favicon uri
	 * @return \mjolnir\base\Layer_HTML $this
	 */
	function favicon($url = null)
	{
		return $this->set('favicon', $url);
	}

	/**
	 * @param string title
	 * @return \mjolnir\base\Layer_HTML $this
	 */
	function title($title)
	{
		return $this->set('title', $title);
	}

	/**
	 * @param string
	 * @return \mjolnir\base\Layer_HTML $this
	 */
	function add_stylesheet($href, $type = "text/css")
	{
		$this->params['stylesheets'][] = array('href' => $href, 'type' => $type);
		return $this;
	}

	/**
	 * @param string markup
	 * @return \mjolnir\base\Layer_HTML $this
	 */
	function add_extra_markup($markup)
	{
		$this->params['extra_markup'][] = $markup;
		return $this;
	}

	/**
	 * @param string markup
	 * @return \mjolnir\base\Layer_HTML
	 */
	function add_footer_markup($markup)
	{
		$this->params['extra_footer_markup'][] = $markup;
		return $this;
	}

	/**
	 * @param string
	 * @return \mjolnir\base\Layer_HTML $this
	 */
	function add_script($src)
	{
		if ( ! \in_array($src, $this->params['scripts']))
		{
			$this->params['scripts'][] = $src;
		}
		
		return $this;
	}

	/**
	 * @param string
	 * @return \mjolnir\base\Layer_HTML $this
	 */
	function add_head_script($src)
	{
		$this->params['head_scripts'][] = $src;
		return $this;
	}

	/**
	 * @param string description
	 * @return \mjolnir\base\Layer_HTML $this
	 */
	function description($desc = null)
	{
		return $this->set('description', $desc);
	}

	/**
	 * @param array new keywards
	 * @return \mjolnir\base\Layer_HTML $this
	 */
	function add_keywords(array $keywords)
	{
		foreach ($keywords as $keyword)
		{
			$this->params['keywords'][] = $keyword;
		}

		return $this;
	}

	/**
	 * @param string canonical url
	 * @return \mjolnir\base\Layer_HTML $this
	 */
	function canonical($url = null)
	{
		return $this->set('canonical', $url);
	}

	/**
	 * @param boolean enabled?
	 * @return \mjolnir\base\Layer_HTML $this
	 */
	function crawlers($enabled = true)
	{
		return $this->set('crawlers', $enabled);
	}

	/**
	 * @param string url
	 * @return \mjolnir\base\Layer_HTML $this
	 */
	function rssfeed($url = null)
	{
		return $this->set('rssfeed', $url);
	}

	/**
	 * @param string url
	 * @return \mjolnir\base\Layer_HTML $this
	 */
	function atomfeed($url = null)
	{
		return $this->set('atomfeed', $url);
	}

	/**
	 * @param string url
	 * @return \mjolnir\base\Layer_HTML $this
	 */
	function pingback($url = null)
	{
		return $this->set('pingback', $url);
	}

	/**
	 * @param boolean enabled?
	 * @return \mjolnir\base\Layer_HTML $this
	 */
	function humanstxt($enabled = true)
	{
		return $this->set('humanstxt', $enabled);
	}

	/**
	 * Metadata for application running as desktop.
	 *
	 * @param string name
	 * @return \mjolnir\base\Layer_HTML $this
	 */
	function application_name($name = null)
	{
		return $this->set('application_name', $name);
	}

	/**
	 * Metadata for application running as desktop.
	 *
	 * @param string tooltip
	 * @return \mjolnir\base\Layer_HTML $this
	 */
	function application_tooltip($tooltip = null)
	{
		return $this->set('application_tooltip', $tooltip);
	}

	/**
	 * Metadata for application running as desktop.
	 *
	 * @param string starturl
	 * @return \mjolnir\base\Layer_HTML $this
	 */
	function application_starturl($starturl = null)
	{
		return $this->set('application_starturl', $starturl);
	}

	/**
	 * Set error handler (view).
	 *
	 * @return \app\Layer_HTML $this
	 */
	function errorview($handler)
	{
		$this->errorview = $handler;

		return $this;
	}

# Document trait

	/**
	 * Set the document's body.
	 *
	 * @param string document body
	 * @return \mjolnir\base\Layer_HTML $this
	 */
	function body($body)
	{
		if ($this->layer !== null)
		{
			throw new \app\Exception_NotApplicable
				("Can't have both a body and contents.");
		}

		$this->document_body($body);

		return $this;
	}

# /Document trait

} # class
