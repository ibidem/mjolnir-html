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
		$this->formindex = static::nextformindex();
		
		// check if this form was previously submitted
		if (isset($_POST['form']) && $_POST['form'] === $instance->signature())
		{
			$instance->autocomplete = & $_POST;
		}
		else # not post, or not this form
		{
			$instance->autocomplete = null;
		}
		
		return $instance;
	}
	
	/**
	 * @return \mjolnir\types\HTMLForm
	 */
	static function i($standard, $action)
	{
		$instance = static::instance();
		$instance->set('action', $action);
		
		// @todo standardize
		
		return $instance;
	}
	
	/**
	 * 
	 */
	function render()
	{
		
		
		parent::render();
	}
	
	// ------------------------------------------------------------------------
	// Errors & Values
	
	/**
	 * The given values will be used to autofill the form. They may be however
	 * ignored depending on context.
	 * 
	 * @return static $this
	 */
	function autocomplete(array & $hints = null)
	{
		if ($this->autocomplete === null)
		{
			$this->autocomplete =& $hints;
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
			return 'mjform_'.$this->formindex.'_field_'.$id;
		}
		else # form signature
		{
			return 'mjform_'.$this->formindex;
		}
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
