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
	 * @var array
	 */
	protected $logicaloptions = null;

	/**
	 * @var array
	 */
	protected $liefhierarchy = null;

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
	 * The hierarchy will be rendered by disabling entries that point to null.
	 * You may provide intending to the items and set categories to null to
	 * achieve a simple hierarchy system. The &mdash; is recomended for
	 * indentation.
	 *
	 * For pretty displaying it's recomended you parse the options and do a
	 * javascript replacement of the select field.
	 *
	 * @return static $this
	 */
	function options_logical(array $hierarchy = null)
	{
		$this->logicaloptions = $hierarchy;
		return $this;
	}

	/**
	 * In a lief hierarchy only the liefs are selectable. You specify the
	 * hierarchy though an array with inner arrays. If a key points to an
	 * arrays it is considered a group label, otherwise it's rendered as an
	 * option.
	 *
	 * The hierarchy will be rendered by disabling category labels so it
	 * appears consistent (unlike the empty optgroup method).
	 *
	 * The items are expected to be already indented.
	 * Using &mdash; is recomended for indenting leaf hierarchies.
	 *
	 * If you want all items to be selectable use options_logical.
	 *
	 * For pretty displaying it's recomended you parse the options and do a
	 * javascript replacement of the select field.
	 *
	 * @return static $this
	 */
	function options_liefhierarchy(array $hierarchy = null)
	{
		$this->liefhierarchy = $hierarchy;
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

		$this->tagbody_is('');

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

					if ($this->values !== null && \in_array(\strval($value), $this->values, false))
					{
						$option->set('selected', '');
					}

					$optgroup->appendtagbody($option->render());
				}

				$this->appendtagbody($optgroup->render());
			}
		}

		if ($this->logicaloptions !== null)
		{
			foreach ($this->logicaloptions as $key => $label)
			{
				if ($label === null)
				{
					$option = \app\HTMLTag::i('option', $key)
						->set('disabled', '');

					$this->appendtagbody($option->render());
				}
				else # $label !== null
				{
					$option = \app\HTMLTag::i('option', $label)
						->set('value', $key);

					if ($this->values !== null && \in_array(\strval($key), $this->values, false))
					{
						$option->set('selected', '');
					}

					$this->appendtagbody($option->render());
				}
			}
		}

		if ($this->liefhierarchy !== null)
		{
			$this->liefhierarchy_parse_options($this->liefhierarchy);
		}

		return parent::fieldrender();
	}

	/**
	 * Parses hierarchy input array.
	 */
	protected function liefhierarchy_parse_options(array $options)
	{
		foreach ($options as $key => $label)
		{
			if (\is_array($label))
			{
				$option = \app\HTMLTag::i('option', $key)
					->set('disabled', '');

				$this->appendtagbody($option->render());

				$this->liefhierarchy_parse_options($label);
			}
			else # $value not array
			{
				$option = \app\HTMLTag::i('option', $label)
					->set('value', $key);

				if ($this->values !== null && \in_array(\strval($key), $this->values, false))
				{
					$option->set('selected', '');
				}

				$this->appendtagbody($option->render());
			}
		}
	}

} # class
