<?php namespace ibidem\html;

/**
 * @package    ibidem
 * @category   Base
 * @author     Ibidem
 * @copyright  (c) 2012, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class HTMLElement extends \app\Instantiatable
	implements \ibidem\types\Renderable
{	
	/**
	 * @var string
	 */
	protected $name = 'hr';
	
	/**
	 * @var array 
	 */
	private $attributes = array();
	
	/**
	 * @param array classes
	 * @return \app\HTMLElement 
	 */
	private $classes;
	
	/**
	 * @return \app\HTMLElement
	 */
	static function instance($name = 'hr')
	{
		$instance = parent::instance();
		$instance->name = $name;
		
		return $instance;
	}
	
	/**
	 * @param string classes
	 * @return \app\HTMLElement 
	 */
	function classes(array $classes)
	{
		isset($this->classes) or $this->classes = array();
		
		foreach ($classes as $class)
		{
			if ( ! \in_array($class, $this->classes))
			{
				$this->classes[] = $class;
			}
		}
		
		return $this;
	}
	
	/**
	 * @param string attribute 
	 * @return \ibidem\base\HTMLBlockElement $this
	 */
	function remove_attribute($attribute)
	{
		unset($this->attributes[$attribute]);
		
		return $this;
	}
	
	/**
	 * @return array 
	 */
	function get_classes()
	{
		return $this->classes;
	}
	
	/**
	 * @param string name
	 * @param string value 
	 * @return \app\HTMLElement
	 */
	function attribute($name, $value = null)
	{
		if ($value !== null)
		{
			$this->attributes[$name] = $value;
		}
		else # no value; assume single tag
		{
			$this->attributes[$name] = '';
		}
		
		return $this;
	}
	
	/**
	 * Shorthand for attribute
	 * 
	 * @return \app\HTMLElement
	 */
	function attr($name, $value = null)
	{
		return $this->attribute($name, $value);
	}
	
	/**
	 * @param string name
	 * @return string
	 */
	function get_attribute($name)
	{
		return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
	}
	
	/**
	 * @param string id 
	 * @return \app\HTMLElement
	 */
	function id($id)
	{
		return $this->attribute('id', $id);
	}
	
	/**
	 * @return string
	 */
	function render_attributes()
	{
		$attributes = '';
		foreach ($this->attributes as $name => $value)
		{
			$attributes .= ' '.$name.'="'.$value.'"';
		}
		if ($this->classes)
		{
			$classes = \array_shift($this->classes);
			foreach ($this->classes as $class)
			{
				$classes .= ' '.$class;
			}
			$attributes .= ' class="'.$classes.'"';
		}
		
		return $attributes;
	}
	
	/**
	 * @return string
	 */
	function render()
	{
		return '<'.$this->name.$this->render_attributes().'/>';
	}
	
	/**
	 * @return string 
	 */
	function __toString()
	{
		try
		{
			return $this->open();
		}
		catch (\Exception $e)
		{
			return '[ERROR: '.$e->getMessage().']';
		}
	}
	
} # class
