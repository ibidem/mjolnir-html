<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem
 * @copyright  (c) 2012, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class FormField_Password extends \app\FormField_Text
{
	/**
	 * @var string
	 */
	protected $type = 'password';

	/**
	 * @return \mjolnir\base\FormField_Password $this
	 */
	function autocomplete($state = true)
	{
		$this->attribute('autocomplete', $state ? 'on' : 'off');
		return $this;
	}

} # class
