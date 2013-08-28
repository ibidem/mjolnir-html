<?php namespace mjolnir\html\tests;

use \mjolnir\html\HH;

class HHTest extends \PHPUnit_Framework_TestCase
{
	/** @test */ function
	can_be_loaded()
	{
		$this->assertTrue(\class_exists('\mjolnir\html\HH'));
	}

	// @todo tests for \mjolnir\html\HH

} # test
