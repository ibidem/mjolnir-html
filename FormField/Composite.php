<?php namespace ibidem\html;

/**
 * @package    ibidem
 * @category   FormField
 * @author     Ibidem
 * @copyright  (c) 2012, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class FormField_Composite extends \app\FormField
{	
	/**
	 * @var array
	 */
	protected $subfields = [];
	
	/**
	 * @var string 
	 */
	protected $composite_format = null;
	
	/**
	 * @return \app\FormField_Composite
	 */
	function subfields($subfields)
	{
		$this->subfields = $subfields;
		return $this;
	}
	
	function format($format)
	{
		$this->composite_format = $format;
		return $this;
	}
	
	/**
	 * @return string 
	 */
	function render_field()
	{
		if ($this->composite_format === null)
		{
			$field = \app\Collection::implode(' ', $this->subfields, function ($i, $field) {
				return $field->render_field();
			});
		}
		else # format is not null
		{
			$fieldcount = \count($this->subfields);
			$field_tr = [];
			for ($i = 1; $i <= $fieldcount; ++$i)
			{
				$field_tr['%'.$i] = $this->subfields[0]->render_field();
			}
			
			$field = \strtr($this->composite_format, $field_tr);
		}
	
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
