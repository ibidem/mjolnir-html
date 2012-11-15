<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Base
 * @author     Ibidem
 * @copyright  (c) 2012, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class FormField_Select extends \app\FormField
{
	/**
	 * @var string
	 */
	protected static $tag_name = 'select';

	/**
	 * @var string
	 */
	protected $type = null;

	/**
	 * @var array
	 */
	protected $values = [];

	/**
	 * @var array
	 */
	protected $optgroups = [];
	
	/**
	 * @var string
	 */
	protected $active;

	/**
	 * @return \app\FormField_Select $this
	 */
	function values(array $values = null, $key = null, $valueKey = null)
	{		
		if ($values === null) {
			$this->values = [];
			return $this;
		}

		if ($key === null)
		{
			foreach ($values as $key => $value)
			{
				$this->values[$key] = $value;
			}
		}
		else # not null
		{
			foreach ($values as $entry)
			{
				$this->values[$entry[$valueKey]] = $entry[$key];
			}
		}

		return $this;
	}
	
	/**
	 * @return \app\FormField_Select
	 */
	function optgroups(array $optgroups = null)
	{	
		if ($optgroups === null)
		{
			$this->optgroups = [];
		}
		else # optgroup not null
		{
			$this->optgroups = $optgroups;
		}
		
		return $this;
	}

	/**
	 * @return \app\FormField_Select $this
	 */
	function value($id)
	{
		$this->value_was_set = true;
		$this->active = $id;
		
		return $this;
	}

	/**
	 * @return string
	 */
	function render_field()
	{
		$this->resolve_autocomplete();
		$field = '<'.$this->name.' '.$this->form->sign().' id="'.$this->form->form_id().'_'.$this->tabindex.'"'.$this->render_attributes().'>';
		
		foreach ($this->values as $title => $key)
		{
			if ($key == $this->active)
			{
				$field .= '<option value="'.$key.'" selected="selected">'.$title.'</option>';
			}
			else # non-active
			{
				$field .= '<option value="'.$key.'">'.$title.'</option>';
			}
		}		
		
		foreach ($this->optgroups as $optgroup => $options)
		{
			$field .= '<optgroup label="'.$optgroup.'">';
			
			foreach ($options as $title => $key)
			{
				if ($key == $this->active)
				{
					$field .= '<option value="'.$key.'" selected="selected">'.$title.'</option>';
				}
				else # non-active
				{
					$field .= '<option value="'.$key.'">'.$title.'</option>';
				}
			}
			
			$field .= '</optgroup>';
		}
		
		$field .= '</'.$this->name.'>';

		if (\strpos($this->template, ':errors') === false)
		{
			$field .= $this->render_errors();
		}

		return $field;
	}

} # class
