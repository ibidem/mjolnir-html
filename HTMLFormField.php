<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem Team
 * @copyright  (c) 2012, 2013, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class HTMLFormField extends \app\HTMLTag implements \mjolnir\types\HTMLFormField
{
	use \app\Trait_HTMLFormField;
	
	/**
	 * @return static
	 */
	static function instance()
	{
		$instance = parent::instance();
		$instance->tagname_is('input');
		
		return $instance;
	}
	
	// ------------------------------------------------------------------------
	// etc
	
	/**
	 * @return static $this
	 */
	function form_is(\mjolnir\types\HTMLForm $form)
	{
		$this->form = $form;
		$this->set('form', $form->signature());
		
		return $this;
	}
	
	/**
	 * @return static $this
	 */
	function form()
	{
		return $this->form;
	}
	
} # class
