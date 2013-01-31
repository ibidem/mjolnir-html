<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem Team
 * @copyright  (c) 2012, 2013, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class HTMLFormField_Radio extends \app\HTMLFormField implements \mjolnir\types\HTML_Boolean
{
	use \app\Trait_HTMLFormField_Boolean;	
	
	/**
	 * @return static
	 */
	static function instance()
	{
		$instance = parent::instance();
		
		return $instance;
	}

	/**
	 * ...
	 */
	function value_is($fieldvalue)
	{
		$this->tagbody_is($fieldvalue);
		return $this;
	}
	
} # class
