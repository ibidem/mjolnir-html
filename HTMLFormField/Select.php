<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem Team
 * @copyright  (c) 2012, 2013, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class HTMLFormField_Select extends \app\HTMLFormField implements \mjolnir\types\HTMLFormField_Select
{
	use \app\Trait_HTMLFormField_Select;	
	
	/**
	 * @return static
	 */
	static function instance()
	{
		$instance = parent::instance();
		$instance->tagname_is('select');
		
		return $instance;
	}

	// ------------------------------------------------------------------------
	// interface: Rendered
	
	/**
	 * @return string
	 */
	function render()
	{
		$this->autocompletefield();
		
		$this->tagbody_is(null);
		
		if ($this->options !== null)
		{
			foreach ($this->options as $value => $label)
			{
				$tag = \app\HTMLTag::i('option', $label)->set('value', $value);
				
				if (\in_array($value, $this->values, false))
				{
					$tag->set('selected', '');
				}
				
				$this->appendtagbody($tag->render());
			}
		}
		
		return parent::render();
	}
	
} # class
