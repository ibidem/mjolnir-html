<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem Team
 * @copyright  (c) 2012, 2013, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class HTMLFormField extends \app\HTMLTag implements \mjolnir\types\HTMLFormField
{
	use \app\Trait_HTMLFormField;

	/**
	 * @return static
	 */
	static function instance()
	{
		$instance = parent::instance();
		$instance->tagname_is('input');

		return $instance;
	}

	// ------------------------------------------------------------------------
	// interface: Rendered

	/**
	 * [!!] call autocompletefield before any other logic, when overwriting
	 *
	 * @return string
	 */
	function render()
	{
		$this->autocompletefield();

		$this->fieldtemplate !== null or $this->fieldtemplate = ':field';

		return \strtr
			(
				$this->fieldtemplate,
				$this->fieldfillers()
			);
	}

	/**
	 * Hook for adding additional fillers for hotwiring funcitonality.
	 *
	 * eg. say you need special classes on labels, you would overwrite this
	 * method to enable your templates to understand new inputs
	 *
	 * @return array
	 */
	protected function fieldfillers()
	{
		$fieldrender = $this->fieldrender();

		if ($this->hintrenderer !== null)
		{
			$callable = &$this->hintrenderer;
			$hintsrender = $callable($this->hints());
		}
		else # no hint renderer
		{
			$hintsrender = null;
		}

		if ($this->showerrors && $this->errorrenderer)
		{
			$callable = &$this->errorrenderer;
			$errorrrender = $callable($this->errors());
		}
		else # no error renderer
		{
			$errorrrender = null;
		}

		return array
			(
				':id'     => $this->get('id', null),
				':field'  => $fieldrender,
				':label'  => $this->fieldlabel(),
				':hints'  => $hintsrender,
				':errors' => $errorrrender,
			);
	}

	// ------------------------------------------------------------------------
	// etc

	/**
	 * @return static $this
	 */
	function form_is(\mjolnir\types\HTMLForm $form)
	{
		$this->form = $form;
		$this->set('form', $form->signature());

		return $this;
	}

	/**
	 * @return static $this
	 */
	function form()
	{
		return $this->form;
	}

	// ------------------------------------------------------------------------
	// Helpers

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
				$this->value_is($autovalue);
			}

			$this->autocompleted = true;
		}
	}

} # class
