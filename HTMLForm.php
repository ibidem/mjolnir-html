<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem Team
 * @copyright  (c) 2012, 2013, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class HTMLForm extends \app\HTMLTag implements \mjolnir\types\HTMLForm
{
	use \app\Trait_HTMLForm;	
	
	/**
	 * @var int
	 */
	protected static $formcounter = 1;
	
	/**
	 * @var int
	 */
	protected $fieldcounter = 1;
	
	/**
	 * @var array
	 */
	protected $autocomplete = null;
	
	/**
	 * @var int 
	 */
	protected $formindex = null;
	
	/**
	 * @return \mjolnir\types\HTMLForm
	 */
	static function instance()
	{
		$instance = parent::instance();
		$instance->tagname_is('form');
		$instance->formindex = static::nextformindex();
		$instance->set('id', $instance->signature());
		
		// check if this form was previously submitted
		if (isset($_POST['form']) && $_POST['form'] === $instance->signature())
		{
			$instance->autocomplete = &$_POST;
		}
		else # POST not set, or fields not submitted for this form
		{
			$instance->autocomplete = null;
		}
		
		return $instance;
	}
	
	/**
	 * @return \mjolnir\types\HTMLForm
	 */
	static function i($standard, $action = null)
	{
		$action !== null or $action = ''; # default to current page
		
		$instance = static::instance();
		$instance->set('action', $action);
		
		// apply standard
		if ($standard != null)
		{
			$instance->apply($standard);
		}
		
		return $instance;
	}
	
	// ------------------------------------------------------------------------
	// Primary Field Management
	
	/**
	 * [!!] pseudofieldtype intentionally doesn't default to null
	 * 
	 * [!!] pseudofieldtype is NOT fieldtype, if it is the identifier for what
	 * it is suppose to be
	 * 
	 * @return \mjolnir\types\HTMLFormField
	 */
	function field($label, $fieldname, $fieldtype)
	{
		// field type loaders
		$fieldtypes = \app\CFS::config('mjolnir/htmlform')['fieldtypes'];
		
		if (isset($fieldtypes[$fieldtype]))
		{
			$instance = $fieldtypes[$fieldtype]($this);
		}
		else # assume specialized class definition with no fieldtype loader
		{
			$class = '\app\HTMLFormField_'.\ucfirst($fieldtype);
			$instance = $class::instance();
		}
		
		// configure and return
		return $instance
			->set('id', $this->signature($this->fieldcounter++))
			->set('name', $fieldname)
			->form_is($this)
			->fieldlabel_is($label)
			->fieldtemplate_is($this->fieldtemplate($fieldtype))
			->hintrenderer_is($this->hintrenderer($fieldtype))
			->errorrenderer_is($this->errorrenderer($fieldtype))
			->adderrors($this->errors($fieldname));
	}
	
	/**
	 * Any additonal parameters are interpreted as HTMLFormFields that are part 
	 * of the composite.
	 * 
	 * If an array is passed as second parameter the fields will be interpreted 
	 * as text HTMLFormFields.
	 * 
	 * Therefore the following:
	 * 
	 *		$form->composite('Name', ['given_name', 'family_name']);
	 * 
	 * Is equivalent to this:
	 * 
	 *		$form->composite
	 *			(
	 *				'Name', 
	 *				$form->text(null, 'given_name'),
	 *				$form->text(null, 'family_name')
	 *			);
	 *
	 * You may also specify a type by making entries associative:
	 *	
	 *		[ 'address' => 'text', 'zipcode' => 'number' ]
	 * 
	 * @return \mjolnir\types\HTMLFormField_Composite
	 */
	function composite($label)
	{
		$args = \func_get_args();
		\array_shift($args); # remove $label
		
		$composite = \app\HTMLFormField_Composite::instance();
		$composite->fieldlabel_is($label);
		
		if (\count($args) >= 1)
		{
			if (\is_array($args[0]))
			{
				$array_shorthand = \array_shift($args);
				foreach ($array_shorthand as $key => $value)
				{
					if (\is_int($key))
					{
						// treat value as fieldname
						$composite->addfield($this->field(null, $value, 'text'));
					}
					else # key is not a int
					{
						// treat key as fieldname and value as fieldtype
						$composite->addfield($this->field(null, $key, $value));
					}
				}
			}
			
			// add remaining HTMLFormFields
			foreach ($args as $field)
			{				
				$composite->addfield($field);
			}
		}
		
		$composite
			->form_is($this)
			->fieldlabel_is($label)
			->fieldtemplate_is($this->fieldtemplate('composite'))
			->hintrenderer_is($this->hintrenderer('composite'))
			->errorrenderer_is($this->errorrenderer('composite'));
		
		return $composite;
	}
	
	// ------------------------------------------------------------------------
	// Errors & Values
	
	/**
	 * The given values will be used to autofill the form. They may be however
	 * ignored depending on context.
	 * 
	 * @return static $this
	 */
	function autocomplete(array &$hints = null)
	{
		if ($this->autocomplete === null)
		{
			$this->autocomplete = &$hints;
		}
		else if ($hints !== null)
		{
			foreach ($hints as $key => $hint)
			{
				$this->autocomplete[$key] = $hint;
			}
		}
		
		return $this;
	}
	
	/**
	 * Retrieve autocomplete value for given field or null.
	 * 
	 * @return mixed or null
	 */
	function autovalue($fieldname)
	{
		if ($this->autocomplete !== null)
		{
			$fieldname = \rtrim($fieldname, '[]');
			if (isset($this->autocomplete[$fieldname]))
			{
				return $this->autocomplete[$fieldname];
			}
		}
		
		// no auto complete value found
		return null;
	}
	
	// ------------------------------------------------------------------------
	// Utility
	
	/**
	 * Returns the form signature or creates signature using given id and form
	 * signature.
	 * 
	 * @return string
	 */
	function signature($id = null)
	{
		if ($id !== null)
		{
			return 'mjform'.$this->formindex.'_field'.$id;
		}
		else # form signature
		{
			return 'mjform'.$this->formindex;
		}
	}
	
	
	// ------------------------------------------------------------------------
	// Autoconfiguration

	/**
	 * @return static $this
	 */
	function basicuploader()
	{
		$this->set('enctype', 'multipart/form-data');
		return $this;
	}
	
	/**
	 * @return static $this
	 */
	function nonuploader()
	{
		$this->set('enctype', null);
		return $this;
	}
	
	// ------------------------------------------------------------------------
	// interface: Renderable
	
	/**
	 * A `form` hidden field will be inserted into the form to identify the data
	 * submitted belonged to this form.
	 * 
	 * @return string
	 */
	function render()
	{
		$this->appendtagbody($this->hidden('form')->value_is($this->signature()));
		return parent::render();
	}
	
	// ------------------------------------------------------------------------
	// Helpers
	
	/**
	 * @return string
	 */
	static function nextformindex()
	{
		return static::$formcounter++;
	}
	
} # class
