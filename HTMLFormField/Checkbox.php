<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem Team
 * @copyright  (c) 2012, 2013, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class HTMLFormField_Checkbox extends \app\HTMLFormField implements \mjolnir\types\HTMLFormField_Switch
{
	use \app\Trait_HTMLFormField_Switch;

	#
	# Checkbox intentionally doesn't inherit Radio
	#

	/**
	 * @return static
	 */
	static function instance()
	{
		$i = parent::instance();
		$i->set('type', 'checkbox');

		$i->value_is(1); # default value sent to server when checked

		return $i;
	}

	/**
	 * This helper will run once. Classes that overwrite render should call this
	 * method before performing calculations.
	 */
	protected function autocompletefield()
	{
		if ( ! $this->autocompleted)
		{
			$fieldname = $this->get('name', null);

			if ($fieldname !== null && ($autovalue = $this->form->autovalue($fieldname)) !== null)
			{
				#
				# The checkbox is simply a switch for a value. So if the
				# autocomplete value is equal to the field's current value then
				# the field is checked. Otherwise the field is unchecked.
				#

				$value = $this->get('value', 'mjolnir:no-value');
				if ($value !== 'mjolnir:no-value')
				{
					if ($value == $autovalue)
					{
						$this->checked();
					}
					else # autovalue != value && autovalue !== null
					{
						$this->unchecked();
					}
				}
			}

			$this->autocompleted = true;
		}
	}

} # class
