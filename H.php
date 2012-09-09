<?php namespace mjolnir\html;

/**
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem
 * @copyright  (c) 2012, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class H
{
	/**
	 * @var int 
	 */
	static protected $level = 1;
	
	/**
	 * @return int
	 */
	static function current()
	{
		return 'h'.static::$level;
	}
	
	/**
	 * Set level; both tag and integer are acceptable.
	 */
	static function set($level)
	{
		$level = \preg_replace('#^h#', '', $level);
		static::$level = \intval($level, 10);
		
		if (static::$level > 6)
		{
			static::$level = 6;
		}
		
		if (static::$level < 1)
		{
			static::$level = 1;
		}
	}
	
	/**
	 * @return int
	 */
	static function up($h = null)
	{
		if ($h === null)
		{
			$h = & static::$level;
		}
		else # we got a level
		{
			$h = \ltrim($h, 'hH');
		}
		
		if ($h < 6)
		{
			++$h;
		}
		
		return 'h'.$h;
	}
	
	/**
	 * @return int
	 */
	static function down($h = null)
	{
		if ($h === null)
		{
			$h = & static::$level;
		}
		else # we got a level
		{
			$h = \ltrim($h, 'hH');
		}
		
		if ($h > 1)
		{
			--$h;
		}
		
		return 'h'.$h;
	}

} # class
