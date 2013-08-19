<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   HTMLFormField
 * @author     Ibidem Team
 * @copyright  (c) 2013, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class HTMLFormField_Date extends \app\HTMLFormField # no specialized interface
{
	/**
	 * @var string
	 */
	protected $dateformat = 'Y-m-d';

	/**
	 * @return static
	 */
	static function instance()
	{
		$instance = parent::instance();
		$instance->set('type', 'date');

		return $instance;
	}

	/**
	 * @return static $this
	 */
	function dateformat_is($new_dateformat)
	{
		$value = $this->get('value');

		if ($value !== null)
		{
			$date = \DateTime::createFromFormat($this->dateformat, $value);
			$this->set('value', $date->format($new_dateformat));
		}

		$this->dateformat = $new_dateformat;

		return $this;
	}

	/**
	 * ...
	 */
	function value_is($fieldvalue)
	{
		if (\is_a($fieldvalue, '\DateTime'))
		{
			// if we don't explicitly set it, the format will be Y-m-d H:i:s
			// which won't work on this type of field
			$this->set('value', $fieldvalue->format('Y-m-d'));
		}
		else # not a DateTime object
		{
			$this->set('value', $fieldvalue);
		}

		return $this;
	}

} # class
