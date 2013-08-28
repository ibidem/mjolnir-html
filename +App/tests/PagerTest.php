<?php namespace mjolnir\html\tests;

use \mjolnir\html\Pager;

class PagerTest extends \PHPUnit_Framework_TestCase
{
	/** @test */ function
	can_be_loaded()
	{
		$this->assertTrue(\class_exists('\mjolnir\html\Pager'));
	}

	// @todo tests for \mjolnir\html\Pager

} # test
