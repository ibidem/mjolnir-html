<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem Team
 * @copyright  (c) 2013, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class Pager extends \app\Instantiatable implements \mjolnir\types\Pager
{
	use \app\Trait_Pager;

	/**
	 * @return static
	 */
	static function instance($itemcount = 0, $baseurl = null, $pagediff = null, $pagelimit = null)
	{
		$instance = parent::instance();

		$instance->set('itemcount', $itemcount);
		$instance->set('baseurl', $baseurl !== null ? $baseurl : '');
		$instance->set('pagediff', $pagediff !== null ? $pagediff : 3);
		$instance->set('pagelimit', $pagelimit !== null ? $pagelimit : 25);

		$instance->configure_internals();

		$instance->file_is('mjolnir/pager/nopages');

		return $instance;
	}

	/**
	 * Setup pager
	 */
	protected function calculate_pager_attributes()
	{
		// is file set?
		if ( ! $this->filepath())
		{
			$this->file_is(\app\CFS::config('mjolnir/pager')['pager.default']);
		}

		// extract options to work in context
		\extract($this->metadata, EXTR_REFS);

		// is the ruler showed?
		$ruler !== null or $ruler = ! empty($currentpage);

		// calculate page count
		$pagecount = \ceil($itemcount / $pagelimit);

		// do we have a bookmark?
		if ($bookmark_entry != 0)
		{
			$bookmark_page = \ceil($bookmark_entry / $pagelimit);
		}

		$startpoint = ($pagecount < $pagediff ? $pagecount : $pagediff);
		$endpoint = ($pagecount - $pagediff + 1 < 1 ? 1 : $pagecount - $pagediff + 1);

		$startellipsis = $startpoint;
		$endellipsis = $endpoint;

		if ($endellipsis == $bookmark_page)
		{
			$endellipsis -= 1;
		}

		if ($startpoint >= $currentpage - $pagediff)
		{
			$startpoint = $pagediff * 3 + 1 - 3;
			$startellipsis = 0;
		}

		if ($endpoint <= $currentpage + $pagediff)
		{
			$endpoint = $pagecount - ($pagediff * 3 - 3);
			$endellipsis = 0;
		}
	}

	// ------------------------------------------------------------------------
	// Interogation

	/**
	 * @return int total number of pages
	 */
	function pagecount()
	{
		return \ceil($this->get('itemcount') / $this->get('pagelimit'));
	}

} # class
