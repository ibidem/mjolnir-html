<?php namespace mjolnir\html\tests;

use \mjolnir\html\HTMLTag;

class HTMLTagTest extends \PHPUnit_Framework_TestCase
{
	/** @test */ function
	can_be_loaded()
	{
		$this->assertTrue(\class_exists('\mjolnir\html\HTMLTag'));
	}

	// @todo tests for \mjolnir\html\HTMLTag

} # test
