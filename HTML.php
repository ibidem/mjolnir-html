<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem Team
 * @copyright  (c) 2013, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class HTML
{
	/**
	 * @var int
	 */
	static protected $tabindex = 1;

	/**
	 * @return int;
	 */
	static function tabindex()
	{
		return static::$tabindex++;
	}

	/**
	 * @return \mjolnir\types\HTMLTag
	 */
	static function anchor($tagbody, $href = null)
	{
		return \app\HTMLTag::i('a', $tagbody)->set('href', $href);
	}

	/**
	 * @return \mjolnir\types\HTMLForm
	 */
	static function form($action, $standard = null)
	{
		return \app\HTMLForm::i($standard, $action)
			->set('method', 'POST');
	}

	/**
	 * @return \mjolnir\types\HTMLForm
	 */
	static function queryform($action = '', $standard = null)
	{
		return \app\HTMLForm::i($standard, $action)
			->set('method', 'GET')
			->disable_metainfo();
	}

} # class
