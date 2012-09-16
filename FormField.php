<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Base
 * @author     Ibidem
 * @copyright  (c) 2012, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class FormField extends \app\HTMLElement
{
	/**
	 * @var string
	 */
	protected static $tag_name = 'input';

	/**
	 * @var string
	 */
	protected $type = 'text';

	/**
	 * @var string
	 */
	protected $name = 'input';

	/**
	 * @var type
	 */
	protected $tabindex;

	/**
	 * @var \app\Form
	 */
	protected $form;

	/**
	 * @var string
	 */
	protected $template;

	/**
	 * @var string
	 */
	protected $helptemplate;

	/**
	 * @var string
	 */
	protected $help = null;

	/**
	 * @var string
	 */
	protected $error_printer_handler = null;

	/**
	 * @param string title
	 * @param string name
	 * @param \mjolnir\types\Form form
	 * @return \app\FormField
	 */
	static function instance($title = null, $name = null, \mjolnir\types\Form $form = null)
	{
		$instance = parent::instance(static::$tag_name);
		$instance->title = $title;
		$instance->attribute('name', $name);
		if ($instance->type)
		{
			$instance->attribute('type', $instance->type);
		}
		$instance->tabindex = \app\Form::tabindex();

		$instance->form = $form;

		if ($instance->type !== 'hidden' && $instance->type !== 'password' && ($field_value = $form->field_value($name)) !== null)
		{
			$instance->value($field_value);
		}

		return $instance;
	}

	/**
	 * @param string value
	 * @return \app\FormField $this
	 */
	function value($value)
	{
		$this->attribute('value', $value);
		return $this;
	}

	/**
	 * @return \app\FormField $this
	 */
	function disabled()
	{
		$this->attribute('disabled');
		return $this;
	}

	/**
	 * @param string template
	 * @return \app\FormField
	 */
	function template($template)
	{
		$this->template = $template;
		return $this;
	}

	/**
	 * @param string template
	 * @return \app\FormField
	 */
	function helptemplate($template)
	{
		$this->helptemplate = $template;
		return $this;
	}

	/**
	 * @return string
	 */
	function help($help)
	{
		$this->help = $help;
		return $this;
	}

	/**
	 * @return string
	 */
	function get_template()
	{
		return $this->template;
	}

	/**
	 * @return string
	 */
	function get_helptemplate()
	{
		return $this->helptemplate;
	}

	/**
	 * @return \app\FormField $this
	 */
	function field()
	{
		$this->template = ':field';
		return $this;
	}

	/**
	 * @return \app\FormField $this
	 */
	function unnamed()
	{
		$this->remove_attribute('name');
		return $this;
	}

	/**
	 * @param bool switch
	 * @return \app\FormField $this
	 */
	function autocomplete($switch = true)
	{
		$this->attribute('autocomplete', $switch ? 'on' : 'off');
		return $this;
	}

	/**
	 * @return string
	 */
	function render_name()
	{
		$classes = $this->get_classes();
		if ($classes)
		{
			return \app\HTMLBlockElement::instance('label', $this->title)
				->attribute('for', $this->form->form_id().'_'.$this->tabindex)
				->classes($this->get_classes())
				->render();
		}
		else # has no classes
		{
			return \app\HTMLBlockElement::instance('label', $this->title)
				->attribute('for', $this->form->form_id().'_'.$this->tabindex)
				->render();
		}
	}

	/**
	 * @return \app\FormField $this
	 */
	function error_printer($error_printer)
	{
		$this->error_printer_handler = $error_printer;
		return $this;
	}

	/**
	 * @return string
	 */
	function print_errors($errors)
	{
		if ($this->error_printer_handler === null)
		{
			$error_render = '<ul class="errors">';
			foreach ($errors as $error)
			{
				$error_render .= '<li>'.\app\Lang::tr($error).'</li>';
			}
			$error_render .= '</ul>';

			return $error_render;
		}
		else # custom error printer
		{
			$handler = $this->error_printer_handler;
			return $handler($errors);
		}
	}

	/**
	 * @return string
	 */
	function render_errors()
	{
		$error_render = '';

		if ($errors = $this->form->errors_for($this->get_attribute('name')))
		{
			$error_render = $this->print_errors($errors);
		}

		return $error_render;
	}

	/**
	 * @return string
	 */
	function render_field()
	{
		$field = '<'.$this->name.' form="'.$this->form->form_id().'" id="'.$this->form->form_id().'_'.$this->tabindex.'"'.$this->render_attributes().'/>';

		if (\strpos($this->template, ':errors') === false)
		{
			$field .= $this->render_errors();
		}

		return $field;
	}

	function render_helptext()
	{
		if (empty($this->help))
		{
			return '';
		}
		else # help not empty
		{
			return \strtr($this->helptemplate, [':help' => $this->help]);
		}
	}

	/**
	 * @return string
	 */
	function render()
	{
		return \strtr
			(
				$this->template,
				array
				(
					':name' => $this->render_name(),
					':field' => $this->render_field(),
					':errors' => $this->render_errors(),
					':help' => $this->render_helptext()
				)
			);
	}

	/**
	 * [!!] this is a shorhand for render; if possible just use render directly
	 *
	 * @return string
	 */
	function __toString()
	{
		try
		{
			return $this->render();
		}
		catch (\Exception $e)
		{
			return '[ERROR: '.$e->getMessage().']';
		}
	}

} # class
