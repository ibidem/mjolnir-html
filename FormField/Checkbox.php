<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Base
 * @author     Ibidem
 * @copyright  (c) 2012, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class FormField_Checkbox extends \app\FormField
{
	/**
	 * @var string 
	 */
	protected $type = 'checkbox';
	
	/**
	 * @param bool checked
	 * @return \mjolnir\base\FormField_Checkbox $this
	 */
	function checked($checked = true)
	{
		if ($checked)
		{
			$this->attribute('checked', 'checked');
		}
		else # not checked
		{
			$this->remove_attribute('checked');
		}
		
		return $this;
	}
	
	/**
	 * @return \app\FormField_Checkbox $this
	 */
	function check_value($value)
	{
		if (\is_bool($value))
		{
			$this->checked($value);
		}
		else if (\in_array($value, ['1', 'on', 'yes']))
		{
			$this->checked(true);
		}
		else if (\in_array($value, ['0', 'off', 'no']))
		{
			$this->checked(false);
		}
		else # unknown
		{
			// checkboxes are usually in very critical places; we don't want any 
			// ambigous handling that can totally fuck up in a spectacular way
			// such as show "no access" instead of "allowed" in a ACL
			throw new \app\Exception('Value can not be interpreted.');
		}
		
		return $this;
	}

} # class
