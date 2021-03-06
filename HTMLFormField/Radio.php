<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem Team
 * @copyright  (c) 2012, 2013, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class HTMLFormField_Radio extends \app\HTMLFormField implements \mjolnir\types\HTMLFormField_Switch
{
	use \app\Trait_HTMLFormField_Switch;

	#
	# Radio intentionally doesn't inherit Checkbox
	#

	/**
	 * @return static
	 */
	static function instance()
	{
		$instance = parent::instance();
		$instance->set('type', 'radio');

		return $instance;
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
				if ($this->get('value', false) == $autovalue)
				{
					$this->checked();
				}
			}

			$this->autocompleted = true;
		}
	}

} # class
