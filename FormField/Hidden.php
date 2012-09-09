<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Base
 * @author     Ibidem
 * @copyright  (c) 2012, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class FormField_Hidden extends \app\FormField
{
	/**
	 * @var string 
	 */
	protected $type = 'hidden';
	
	/**
	 * @param string name
	 * @param \mjolnir\types\Form form 
	 * @return \mjolnir\base\FormField_Hidden
	 */
	static function instance($name = null, \mjolnir\types\Form $form = null)
	{
		return parent::instance(null, $name, $form);
	}
	
	/**
	 * @return string 
	 */
	function render()
	{
		return $this->render_field();
	}
	
} # class
