<?php namespace mjolnir\html;

/**
 * HH stands for HTMLHeader, this the full implementation and not simply an
 * alias to a HTMLHeader class because the use of both in code would be a little
 * too noisy and confusing.
 *
 * This class maintains utilities for working in "header units"
 *
 * eg.
 *
 *		HH::next(); # => 'h1'
 *		HH::next(); # => 'h2'
 *
 *		HH::raise('h2'); # => 'h3'
 *		HH::raise('h6'); # => 'h6'
 *
 * You should always store your header units in variables and use them later;
 * using the functions directly isn't practical.
 *
 * eg.
 *
 *		$h1 = HH::next();
 *		$h2 = HH::next();
 *		// ...
 *		<?= HTMLTag::i($h1, 'My Title')->render() ?>
 *		// or...
 *		<?= "<$h2>My Title</$h2>" ?>
 *
 * Note that $h1 isn't necesarily 'h1' and $h2 isn't necesarily 'h2'. If the
 * piece of code in the example was in a partial the headers might be h3 and h4.
 *
 * [!!] it is recomended you pass the last header to partials; by convention $h
 *
 * eg.
 *
 *		HH::base($h)
 *		$h1 = HH::next();
 *		$h2 = HH::next();
 *
 * The following is equivalent to the above.
 *
 *		$h1 = HH::raise($h);
 *		$h2 = HH::raise($h1);
 *
 * If you ever need to reset to h1, simply call HH::base(null), or you can just
 * hard code it by doing $h1 = 'h1' and moving from there.
 *
 * @package    mjolnir
 * @category   Html
 * @author     Ibidem Team
 * @copyright  (c) 2013, Ibidem Team
 * @license    https://github.com/ibidem/ibidem/blob/master/LICENSE.md
 */
class HH
{
	/**
	 * @var string
	 */
	protected static $currentheader = null;

	/**
	 * ...
	 */
	static function base($headerunit)
	{
		$this->currentheader = $headerunit;
	}

	/**
	 * @return string
	 */
	static function next()
	{
		return static::$currentheader = static::raise(static::$currentheader);
	}

	/**
	 * @return string or null if no next was never called
	 */
	static function currentheader()
	{
		return static::$currentheader;
	}

	/**
	 * null leads to h1 and h6 leads into h6
	 *
	 * @return string next header unit
	 */
	static function raise($headerunit)
	{
		if ($headerunit === null)
		{
			return 'h1';
		}
		else # headerunit !== null
		{
			$index = 1 + \intval(\ltrim($headerunit, 'h'));

			if ($index > 6)
			{
				return 'h6';
			}
			else
			{
				return "h$index";
			}
		}
	}

} # class
