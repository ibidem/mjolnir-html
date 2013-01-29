<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem
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
	 * @return string
	 */
	function render()
	{
		$tagname = $this->tagname();
		$tagname !== null or $tagname = 'span';

		$tagbody = $this->tagbody();
		if ($tagbody !== null && ! \is_string($tagbody))
		{
			$tagbody = $tagbody->render();
		}

		$tagattributes = $this->makeattributes();

		if ($tagbody === null)
		{
			return "<$tagname$tagattributes/>";
		}
		else # body !== null
		{
			return "<$tagname$tagattributes>$tagbody</$tagname>";
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

		foreach ($metadata as $key => $value)
		{
			$metarenderer = $this->metarenderer($key, null);

			if ($metarenderer !== null)
			{
				$attributes .= ' '.$key.'="'.$metarenderer($this).'"';
			}
			else if (\is_array($value))
			{
				$attributes .= ' '.$key.'="'.\implode(' ', $value).'"';
			}
			else # no meta renderer and value is not an array
			{
				$attributes .= " $key=\"$value\"";
			}
		}

		return $attributes;
	}

} # class
