<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Base
 * @author     Ibidem
 * @copyright  (c) 2012, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class Form extends \app\HTMLBlockElement
	implements
		\mjolnir\types\Form,
		\mjolnir\types\Standardized
{
	/**
	 * @var integer
	 */
	protected static $forms_counter = 0;

	/**
	 * @var integer
	 */
	protected static $tabindex = 1;

	/**
	 * @var array
	 */
	protected $saved_formats = [];

	/**
	 * @var boolean
	 */
	protected $secure;

	/**
	 * @var string
	 */
	protected $form_id = 'global';

	/**
	 * @var string
	 */
	protected $field_template;

	/**
	 * @var array
	 */
	protected $targetted_field_template;

	/**
	 * @var string
	 */
	protected $field_helptemplate;

	/**
	 * @var array
	 */
	protected $targetted_field_helptemplate;

	/**
	 * @var string
	 */
	protected $field_error_printer;

	/**
	 * @var array
	 */
	protected $targetted_field_error_printer;

	/**
	 * @var string
	 */
	protected $group_start;

	/**
	 * @var string
	 */
	protected $group_end;

	/**
	 * @var boolean
	 */
	protected $auto_complete;

	/**
	 * @var array
	 */
	protected $registerd_hidden = array();

	/**
	 * @var null|array
	 */
	protected $errors;

	/**
	 * @return \app\Form $this
	 */
	static function instance($id = null)
	{
		$config = \app\CFS::config('mjolnir/form');
		$instance = parent::instance();
		$instance->secure = $config['secure.default'];
		$instance->field_template = $config['template.field'];
		$instance->targetted_field_template = array();
		$instance->attribute('method', $config['method.default']);

		list($instance->group_start, $instance->group_end)
			= \explode(':fields', $config['template.group']);

		if ($id !== null)
		{
			$instance->form_id = $id;
		}
		else # null id, annonymous form
		{
			$instance->form_id = 'form_'.self::$forms_counter++;
		}

		$instance->attribute('id', $instance->form_id);

		// register hidden field for when form is opened and method not GET
		if ($config['method.default'] !== \mjolnir\types\HTTP::GET)
		{
			$instance->registerd_hidden['form'] = $instance->form_id;
		}

		// check if this form was previously submitted
		if (isset($_POST['form']) && $_POST['form'] == $instance->form_id)
		{
			$instance->auto_complete = & $_POST;
		}
		else # not post, or not this form
		{
			$instance->auto_complete = null;
		}

		return $instance;
	}

	/**
	 * @param string standard (defined in ibidem/form[standards]
	 * @return \app\Form $this
	 */
	function standard($standard)
	{
		$standard = \app\CFS::config('mjolnir/form')['standards'][$standard];
		$standard($this);
		return $this;
	}

	/**
	 * Optimizes form for file upload.
	 *
	 * @return \app\Form $this
	 */
	function file_uploader()
	{
		$this->attribute('enctype', 'multipart/form-data');
		return $this;
	}

	/**
	 * @param array fields
	 * @return \app\Form $this
	 */
	function auto_complete(array $fields = null)
	{
		if ($fields === null)
		{
			return $this;
		}

		if ($this->auto_complete === null)
		{
			$this->auto_complete = [];
		}

		foreach ($fields as $key => $field)
		{
			$this->auto_complete[$key] = $field;
		}
		
		return $this;
	}

	/**
	 * @param string name
	 * @return mixed or null
	 */
	function field_value($name)
	{
		if ($this->auto_complete !== null && isset($this->auto_complete[$name]))
		{
			return $this->auto_complete[$name];
		}
		else # no auto_complte for field
		{
			return null;
		}
	}

	/**
	 * @return string
	 */
	function form_id()
	{
		return $this->form_id;
	}

	/**
	 * @param string key
	 * @return array or null errors
	 */
	function errors_for($key)
	{
		if ($this->errors !== null)
		{
			if (isset($this->errors[$key]))
			{
				return $this->errors[$key];
			}
			else # not set
			{
				return null;
			}
		}

		// no errors
		return null;
	}

	/**
	 * @param string id
	 * @return string unique id namespaced to form
	 */
	function for_label($id)
	{
		// add form namespace
		return $this->form_id.'-'.$id;
	}

	/**
	 * @param string template
	 * @return \app\Form $this
	 */
	function field_template($template, array $targets = null)
	{
		if ($targets === null)
		{
			$this->field_template = $template;
		}
		else # targetted template
		{
			if ($template === null)
			{
				foreach ($targets as $target)
				{
					unset($this->targetted_field_template[$target]);
				}
			}
			else # template not null
			{
				foreach ($targets as $target)
				{
					$this->targetted_field_template[$target] = $template;
				}
			}
		}

		return $this;
	}

	/**
	 * @return \app\Form $this
	 */
	function field_helptemplate($template, array $targets = null)
	{
		if ($targets === null)
		{
			$this->field_helptemplate = $template;
		}
		else # targetted template
		{
			if ($template === null)
			{
				foreach ($targets as $target)
				{
					unset($this->targetted_field_helptemplate[$target]);
				}
			}
			else # template not null
			{
				foreach ($targets as $target)
				{
					$this->targetted_field_helptemplate[$target] = $template;
				}
			}
		}

		return $this;
	}

	/**
	 * @return \app\Form $this
	 */
	function field_error_printer($printer, array $targets = null)
	{
		if ($targets === null)
		{
			$this->field_error_printer = $printer;
		}
		else # targetted printer
		{
			if ($printer === null)
			{
				foreach ($targets as $target)
				{
					unset($this->targetted_field_error_printer[$target]);
				}
			}
			else # template not null
			{
				foreach ($targets as $target)
				{
					$this->targetted_field_error_printer[$target] = $printer;
				}
			}
		}

		return $this;
	}

	/**
	 * @param array field errors
	 * @return \app\Form $this
	 */
	function errors(array & $errors = null)
	{
		$this->errors = & $errors;
		return $this;
	}

	/**
	 * @param string $method
	 * @return \app\Form $this
	 */
	function method($method)
	{
		$this->attribute('method', $method);

		if ($method === \mjolnir\types\HTTP::GET)
		{
			unset($this->registerd_hidden['form']);
		}

		return $this;
	}

	/**
	 * @param string action
	 * @return \app\Form $this
	 */
	function action($action)
	{
		$this->attribute('action', $action);
		return $this;
	}

	/**
	 * @return \app\Form $this
	 */
	function insecure()
	{
		$this->secure = false;
		return $this;
	}

	/**
	 * @return \app\Form $this
	 */
	function secure()
	{
		$this->secure = true;
		return $this;
	}

	/**
	 * @param string legend
	 * @return string
	 */
	function group($legend)
	{
		return \strtr($this->group_start, array(':legend' => $legend));
	}

	/**
	 * End of group.
	 *
	 * @return string
	 */
	function end()
	{
		return $this->group_end;
	}

	/**
	 * @return string
	 */
	function open()
	{
		$output = "<form{$this->render_attributes()}>";
		if ( ! empty($this->registerd_hidden))
		{
			foreach ($this->registerd_hidden as $key => $value)
			{
				$output .= $this->hidden($key)->value($value)->render();
			}
		}

		return $output;
	}

	/**
	 * @return string
	 */
	function close()
	{
		return "</form>";
	}

	/**
	 * @return string
	 */
	function get_field_template($name)
	{
		if (isset($this->targetted_field_template[$name]))
		{
			return $this->targetted_field_template[$name];
		}
		else # not targetted
		{
			return $this->field_template;
		}
	}

	/**
	 * @return string
	 */
	function get_field_helptemplate($name)
	{
		if (isset($this->targetted_field_helptemplate[$name]))
		{
			return $this->targetted_field_helptemplate[$name];
		}
		else # not targetted
		{
			return $this->field_helptemplate;
		}
	}

	/**
	 * @return string
	 */
	function get_field_error_printer($name)
	{
		if (isset($this->targetted_field_error_printer[$name]))
		{
			return $this->targetted_field_error_printer[$name];
		}
		else # not targetted
		{
			return $this->field_error_printer;
		}
	}

	/**
	 * @param string title
	 * @param string name
	 * @return \app\FormField_Text
	 */
	function text($title, $name)
	{
		return \app\FormField_Text::instance($title, $name, $this)
			->template($this->get_field_template('text'))
			->helptemplate($this->get_field_helptemplate('text'))
			->error_printer($this->get_field_error_printer('text'));
	}

	/**
	 * @param string title
	 * @param string name
	 * @return \app\FormField_Text
	 */
	function number($title, $name)
	{
		return \app\FormField_Number::instance($title, $name, $this)
			->template($this->get_field_template('number'))
			->helptemplate($this->get_field_helptemplate('number'))
			->error_printer($this->get_field_error_printer('number'));
	}

	/**
	 * @param string title
	 * @param string name
	 * @return \app\FormField_Password
	 */
	function password($title, $name)
	{
		return \app\FormField_Password::instance($title, $name, $this)
			->template($this->get_field_template('password'))
			->helptemplate($this->get_field_helptemplate('password'))
			->error_printer($this->get_field_error_printer('password'));
	}

	/**
	 * @param string title
	 * @param string name
	 * @return \app\FormField_Text
	 */
	function telephone($title, $name)
	{
		return \app\FormField_Text::instance($title, $name, $this)
			->template($this->get_field_template('telephone'))
			->helptemplate($this->get_field_helptemplate('telephone'))
			->error_printer($this->get_field_error_printer('telephone'));
	}

	/**
	 * @param string title
	 * @param string name
	 * @return \app\FormField_Text
	 */
	function email($title, $name)
	{
		return \app\FormField_Text::instance($title, $name, $this)
			->template($this->get_field_template('email'))
			->helptemplate($this->get_field_helptemplate('email'))
			->error_printer($this->get_field_error_printer('email'));
	}

	/**
	 * @param string title
	 * @param string name
	 * @return \app\FormField_Text
	 */
	function file($title, $name)
	{
		return \app\FormField_File::instance($title, $name, $this)
			->template($this->get_field_template('file'))
			->helptemplate($this->get_field_helptemplate('file'))
			->error_printer($this->get_field_error_printer('file'));
	}

	/**
	 * @param string title
	 * @param string name
	 * @return \app\FormField_DateTime
	 */
	function datetime($title, $name)
	{
		return \app\FormField_DateTime::instance($title, $name, $this)
			->template($this->get_field_template('datetime'))
			->helptemplate($this->get_field_helptemplate('datetime'))
			->error_printer($this->get_field_error_printer('datetime'));
	}

	/**
	 * @param string title
	 * @param string name
	 * @return \app\FormField_DateTime
	 */
	function date($title, $name)
	{
		$this->datetime();
	}

	/**
	 * @param string title
	 * @param string name
	 * @return \app\FormField_TextArea
	 */
	function textarea($title, $name)
	{
		return \app\FormField_TextArea::instance($title, $name, $this)
			->template($this->get_field_template('textarea'))
			->helptemplate($this->get_field_helptemplate('textarea'))
			->error_printer($this->get_field_error_printer('textarea'));
	}

	/**
	 * @param string title
	 * @param string name
	 * @param array values
	 * @param string default
	 * @return \app\FormField_Radio
	 */
	function radio($title, $name, array $values, $default)
	{
		return \app\FormField_Radio::instance($title, $name, $this)
			->template($this->get_field_template('radio'))
			->helptemplate($this->get_field_helptemplate('radio'))
			->error_printer($this->get_field_error_printer('radio'))
			->value($default)
			->values($values);
	}

	/**
	 * @param string title
	 * @param string name
	 * @return \app\FormField_Checkbox
	 */
	function checkbox($title, $name)
	{
		return \app\FormField_Checkbox::instance($title, $name, $this)
			->template($this->get_field_template('checkbox'))
			->helptemplate($this->get_field_helptemplate('checkbox'))
			->error_printer($this->get_field_error_printer('checkbox'));
	}

	/**
	 * @param string title
	 * @param string name
	 * @param array values
	 * @return \app\FormField_Select
	 */
	function select($title, $name, array $values = null)
	{
		return \app\FormField_Select::instance($title, $name, $this)
			->template($this->get_field_template('select'))
			->helptemplate($this->get_field_helptemplate('select'))
			->error_printer($this->get_field_error_printer('select'))
			->values($values);
	}

	/**
	 * @param string title
	 * @param string name
	 * @return \app\FormField_Submit
	 */
	function submit($title, $name = null)
	{
		return \app\FormField_Submit::instance($title, $name, $this)
			->template($this->get_field_template('submit'))
			->helptemplate($this->get_field_helptemplate('submit'))
			->error_printer($this->get_field_error_printer('submit'))
			->value($title);
	}

	/**
	 * @param string name
	 * @return \app\FormField_Hidden
	 */
	function hidden($name)
	{
		return \app\FormField_Hidden::instance($name, $this);
	}

	/**
	 * @return \app\FormField_Composite
	 */
	function composite()
	{
		$args = \func_get_args();
		$name = \array_shift($args);

		return \app\FormField_Composite::instance($name, null, $this)
			->template($this->get_field_template('composite'))
			->helptemplate($this->get_field_helptemplate('composite'))
			->error_printer($this->get_field_error_printer('composite'))
			->subfields($args);
	}

	/**
	 * Until endformat is called the format is temporarily changed to the
	 * specified format.
	 */
	function groupformat($format)
	{
		$this->saved_formats[] = $this->field_template;
		$this->field_template = $format;
	}

	/**
	 * Terminates current format, and restores previous.
	 */
	function endformat()
	{
		$this->field_template = \array_pop($this->saved_formats);
	}

	/**
	 * @return string form field signature
	 */
	function sign()
	{
		return 'tabindex="'.static::tabindex().'" form="'.$this->form_id().'"';
	}

	/**
	 * @return integer
	 */
	static function tabindex()
	{
		return self::$tabindex++;
	}

	/**
	 * @return \app\Form
	 */
	static function i($standard, $action)
	{
		return static::instance()->standard($standard)->action($action);
	}

} # class
