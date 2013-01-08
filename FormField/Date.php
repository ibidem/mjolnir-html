<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   FormField
 * @author     Ibidem
 * @copyright  (c) 2012, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class FormField_Date extends \app\FormField_Text
{
	/**
	 * @var string 
	 */
	protected $type = 'date';
	
	/**
	 * @var string
	 */
	protected $date_format = null;
	
	/**
	 * @return \app\FormField_DateTime $this
	 */
	function date_format($format)
	{
		$this->date_format = $format;
		return $this;
	}
	
	/**
	 * @return string
	 */
	function get_date_format()
	{
		if ($this->date_format === null)
		{
			return 'Y-m-d';
		}
		else # got datetime
		{
			return $this->date_format;
		}
	}
	
	/**
	 * @return \app\FormField_DateTime $this
	 */
	function value($value)
	{
		$this->value_was_set = true;
		if (\is_string($value))
		{

			if ($this->date_format === null)
			{
				$this->attribute('value', $value);
			}
			else # datetime_format set
			{
				try
				{
					$datetime = new \DateTime($value);
					$this->attribute('value', $datetime->format($this->get_date_format()));
				}
				catch (\Exception $e) # failed
				{
					$this->attribute('value', '');
				}
			}
		}
		else if (\is_a($value, '\DateTime'))
		{
			$this->attribute('value', $value->format($this->get_date_format()));
		}
		else # non-string and non-datetime
		{
			if ($this->datetime_format === null)
			{
				$this->attribute('value', $value);
			}
			else # datetime_format set
			{
				try
				{
					$datetime = new \DateTime($value);
					$this->attribute('value', $datetime->format($this->get_date_format()));
				}
				catch (\Exception $e) # failed
				{
					$this->attribute('value', '');
				}
			}
		}
		
		return $this;
	}

} # class
