<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem Team
 * @copyright  (c) 2012, 2013, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class HTMLFormField_Hidden extends \app\HTMLFormField
{
	#
	# Intentionally not creating specialized interface / trait for this class.
	#
	
	/**
	 * @return static
	 */
	static function instance()
	{
		$instance = parent::instance();
		$instance->tagname_is('input');
		$instance->set('type', 'hidden');
		
		return $instance;
	}
	
	/**
	 * @return static $this
	 */
	function fieldtemplate_is($template)
	{
		// this is a hidden field it doesn't need a template and the markup 
		// might very well get in the way
		
		return $this;
	}
	
} # class
