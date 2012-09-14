<?php namespace mjolnir\html;

/**
 * @package    mjolnir
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
	
	/**
	 * @return \app\FormField_Composite
	 */
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
				$field_tr['%'.$i] = $this->subfields[$i - 1]->render_field();
			}
			
			$field = \strtr($this->composite_format, $field_tr);
		}
	
		$all_errors = [];
		foreach ($this->subfields as $subfield)
		{
			if ($errors = $this->form->errors_for($subfield->get_attribute('name')))
			{
				foreach ($errors as $error)
				{
					$all_errors[] = $error;
				}
			}
		}
		
		if ( ! empty($all_errors))
		{
			$field .= '<ul class="errors">';
			foreach ($all_errors as $error)
			{
				$field .= '<li>'.\app\Lang::tr($error).'</li>';
			}
			$field .= '</ul>';
		}
		
		return $field;
	}

} # class
