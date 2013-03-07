<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem Team
 * @copyright  (c) 2012, 2013, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class HTMLFormField_Select extends \app\HTMLFormField implements \mjolnir\types\HTMLFormField_Select
{
	use \app\Trait_HTMLFormField_Select;

	/**
	 * @var array
	 */
	protected $options = null;

	/**
	 * @var array
	 */
	protected $optgroups = null;

	/**
	 * @return static
	 */
	static function instance()
	{
		$instance = parent::instance();
		$instance->tagname_is('select');

		return $instance;
	}

	/**
	 * Inserts options via associtive array of key => value pairs.
	 *
	 * See optgroups_array for option group version.
	 *
	 * @return static $this
	 */
	function options_array(array $array = null)
	{
		$this->options = $array;
		return $this;
	}

	/**
	 * Insert options via associative array of groups pointing to associative
	 * array of options. Note that optgroups are treated as seperate entities
	 * to options, so you can have both in the same select.
	 *
	 * If normal options are present, groups are rendered after them.
	 *
	 * @return static $this
	 */
	function optgroups_array(array $optgroups = null)
	{
		$this->optgroups = $optgroups;
		return $this;
	}

	/**
	 * @return string
	 */
	function fieldrender()
	{
		$this->autocompletefield();

		$this->tagbody_is(null);

		if ($this->options !== null)
		{
			foreach ($this->options as $value => $label)
			{
				$option = \app\HTMLTag::i('option', $label)->set('value', $value);

				if ($this->values !== null && \in_array(\strval($value), $this->values, false))
				{
					$option->set('selected', '');
				}

				$this->appendtagbody($option->render());
			}
		}

		if ($this->optgroups !== null)
		{
			foreach ($this->optgroups as $group => $options)
			{
				$optgroup = \app\HTMLTag::i('optgroup')->set('label', $group);

				foreach ($options as $value => $label)
				{
					$option = \app\HTMLTag::i('option', $label)->set('value', $value);

					if (\in_array(\strval($value), $this->values, false))
					{
						$option->set('selected', '');
					}

					$optgroup->appendtagbody($option->render());
				}

				$this->appendtagbody($optgroup->render());
			}
		}

		return parent::fieldrender();
	}

} # class
