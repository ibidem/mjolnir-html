<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem Team
 * @copyright  (c) 2012, 2013, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class HTMLFormField_Composite extends \app\HTMLFormField implements \mjolnir\types\HTMLFormField_Composite
{
	use \app\Trait_HTMLFormField_Composite;

	/**
	 * @var array
	 */
	protected $compositefields = null;

	/**
	 * @return static $this
	 */
	function addfield(\mjolnir\types\HTMLFormField $field)
	{
		$field->noerrors();
		$this->compositefields[] = $field;
		return $this;
	}

	/**
	 * @return string
	 */
	function fieldrender()
	{
		$renders = [];
		if ($this->compositefields !== null)
		{
			foreach ($this->compositefields as $idx => $field)
			{
				$renders['%'.($idx+1)] = $field->fieldrender();
			}
		}

		if ($this->fieldmix !== null)
		{
			return \strtr($this->fieldmix, $renders);
		}
		else # no fieldmix; assume concatanation of all fields
		{
			return \implode(' ', $renders);
		}
	}

} # class
