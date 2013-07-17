<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem Team
 * @copyright  (c) 2013, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class HTMLTag extends \app\Instantiatable implements \mjolnir\types\HTMLTag
{
	use \app\Trait_HTMLTag;

	/**
	 * @return static
	 */
	static function instance()
	{
		$instance = parent::instance();

		$instance->injectmetarenderers(\app\CFS::config('mjolnir/htmltag')['metarenderers']);

		return $instance;
	}

	/**
	 * @return \mjolnir\types\HTMLTag
	 */
	static function i($tagname, $tagbody = null)
	{
		$instance = static::instance();
		$instance->tagname_is($tagname);
		$instance->tagbody_is($tagbody);

		return $instance;
	}

	// ------------------------------------------------------------------------
	// interface: Renderable

	/**
	 * @return string
	 */
	function render()
	{
		$tagname = $this->tagname();
		$tagname !== null or $tagname = 'span';

		$tagbody = $this->tagbody();

		if ( ! \is_array($tagbody))
		{
			$tagbody = [ $tagbody ];
		}

		$totalbody = null;
		foreach ($tagbody as $body)
		{
			if ($body !== null)
			{
				if (\is_object($body))
				{
					$totalbody .= $body->render();
				}
				else # body is non-renderable
				{
					$totalbody .= $body;
				}
			}
		}

		$tagattributes = $this->makeattributes();

		if ($totalbody === null)
		{
			return "<$tagname$tagattributes/>";
		}
		else # body !== null
		{
			return "<$tagname$tagattributes>$totalbody</$tagname>";
		}
	}

	// ------------------------------------------------------------------------
	// Helpers

	/**
	 * @return string
	 */
	protected function makeattributes()
	{
		$metadata = $this->metadata();
		$attributes = '';

		if ($metadata !== null)
		{
			foreach ($metadata as $key => $value)
			{
				if ($value === null)
				{
					continue;
				}

				$metarenderer = $this->metarenderer($key, null);

				if ($metarenderer !== null)
				{
					$attributes .= ' '.$key.'="'.$metarenderer($this).'"';
				}
				else if (\is_array($value))
				{
					$attributes .= ' '.$key.'="'.\implode(' ', $value).'"';
				}
				else if ($value === '')
				{
					$attributes .= " $key";
				}
				else # no meta renderer and value is not an array or empty
				{
					$attributes .= " $key=\"$value\"";
				}
			}
		}

		return $attributes;
	}

} # class
