<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Base
 * @author     Ibidem
 * @copyright  (c) 2012, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class FormField_TextArea extends \app\FormField
{
	/**
	 * @var string 
	 */
	protected static $tag_name = 'textarea';
	
	/**
	 * @var string 
	 */
	protected $type = null;
	
	/**
	 * @var string
	 */
	private $body = '';
	
	/**
	 * @param string title
	 * @param string name
	 * @param \mjolnir\types\Form form
	 * @return \mjolnir\base\FormField_TextArea instance
	 */
	static function instance($title = null, $name = null, \mjolnir\types\Form $form = null)
	{
		$form_config = \app\CFS::config('ibidem/form');
		$instance = parent::instance($title, $name, $form);
		$instance->attribute('rows', $form_config['textarea.rows.default']);
		$instance->attribute('cols', $form_config['textarea.cols.default']);
		
		return $instance;
	}
	
	function value($body = '')
	{
		return $this->body($body);
	}
	
	/**
	 * @param string body
	 * @return \mjolnir\base\HTMLBlockElement 
	 */
	function body($body = '')
	{
		$this->body = $body;
		return $this;
	}
	
	/**
	 * @return string 
	 */
	function render_field()
	{
		$field = '<'.$this->name.' id="'.$this->form->form_id().'_'.$this->tabindex.'"'.$this->render_attributes().'>'
			. $this->body
			. '</'.$this->name.'>';
		
		if ($errors = $this->form->errors_for($this->get_attribute('name')))
		{
			$field .= '<ul class="errors">';
			foreach ($errors as $error)
			{
				$field .= '<li>'.\app\Lang::tr($error).'</li>';
			}
			$field .= '</ul>';
		}
		
		return $field;
	}

} # class
