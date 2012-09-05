<?php namespace ibidem\html;

/**
 * @package    ibidem
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
	static function now()
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
	static function up($level)
	{
		if (static::$level < 6)
		{
			++static::$level;
		}
		
		return 'h'.static::$level;
	}
	
	/**
	 * @return int
	 */
	static function down($level)
	{
		if (static::$level > 1)
		{
			--static::$level;
		}
		
		return 'h'.static::$level;
	}

} # class
