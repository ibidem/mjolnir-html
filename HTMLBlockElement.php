<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem
 * @copyright  (c) 2012, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class HTMLBlockElement extends \app\HTMLElement
{
	/**
	 * @var string
	 */
	private $body = '';

	/**
	 * @return \mjolnir\base\HTMLElement
	 */
	static function instance($name = 'div', $body = '')
	{
		$instance = parent::instance($name);
		$instance->body = $body;

		return $instance;
	}

	/**
	 * @param string body
	 * @return \mjolnir\base\HTMLBlockElement
	 */
	function body($body = '')
	{
		$this->body = $body;
		return $this;
	}

	/**
	 * @return string
	 */
	function render()
	{
		return '<'.$this->name.$this->render_attributes().'>'.$this->body.'</'.$this->name.'>';
	}

} # class
