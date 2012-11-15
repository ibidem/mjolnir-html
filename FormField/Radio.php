<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Base
 * @author     Ibidem
 * @copyright  (c) 2012, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class FormField_Radio extends \app\FormField
{
	/**
	 * @var string
	 */
	protected $type = 'radio';

	/**
	 * @var string
	 */
	protected $default_value;

	/**
	 * @var array
	 */
	protected $values;

	/**
	 * @param string default
	 * @return \mjolnir\base\FormField_Radio $this
	 */
	function value($default_value)
	{
		$this->value_was_set = true;
		// default value can only be set once
		if ($this->default_value === null)
		{
			$this->default_value = $default_value;
		}

		return $this;
	}

	/**
	 * @param array values
	 * @return \mjolnir\base\FormField_Radio $this
	 */
	function values(array $values)
	{
		$this->values = $values;
		return $this;
	}

	/**
	 * @return string
	 */
	function render_field()
	{
		$this->resolve_autocomplete();
		
		$field = '';

		$field_id = $this->form->form_id().'_'.$this->tabindex;

		foreach ($this->values as $value => $title)
		{
			$field .= ' <label for="'.$field_id.'_'.$value.'"><span class="label-title">'.$title.'</span> <'.$this->name.' '.$this->form->sign().' id="'.$field_id.'_'.$value.'"'.$this->render_attributes().($this->default_value === $value ? ' checked="checked"' : '').' value="'.$value.'"/></label>';
		}

		return $field;
	}

} # class
