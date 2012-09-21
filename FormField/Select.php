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
	protected $values = array();

	/**
	 * @var string
	 */
	protected $active;

	/**
	 * @param array values
	 * @return \mjolnir\base\FormField_Select $this
	 */
	function values(array $values = null, $key = null, $valueKey = null)
	{
		if ($values === null) {
			$this->values = array();
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
	 * @param string id
	 * @return \mjolnir\base\FormField_Select $this
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
		$field = '<'.$this->name.' form="'.$this->form->form_id().'" id="'.$this->form->form_id().'_'.$this->tabindex.'"'.$this->render_attributes().'>';
		foreach ($this->values as $title => $key)
		{
			if ($key == $this->active)
			{
				$field .= '<option value="'.$key.'" selected="selected">'.$title.'</option>';
			}
			else
			{
				$field .= '<option value="'.$key.'">'.$title.'</option>';
			}
		}
		$field .= '</'.$this->name.'>';

		if (\strpos($this->template, ':errors') === false)
		{
			$field .= $this->render_errors();
		}

		return $field;
	}

} # class
