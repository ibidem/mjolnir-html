<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem Team
 * @copyright  (c) 2012, 2013, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class HTMLFormField_Textarea extends \app\HTMLFormField # no specialized interface
{
	/**
	 * @return static
	 */
	static function instance()
	{
		$instance = parent::instance();
		$instance->tagname_is('textarea');
		$instance->tagbody_is('');

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
