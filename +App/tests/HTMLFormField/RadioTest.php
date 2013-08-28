<?php namespace mjolnir\html\tests;

use \mjolnir\html\HTMLFormField_Radio;

class HTMLFormField_RadioTest extends \PHPUnit_Framework_TestCase
{
	/** @test */ function
	can_be_loaded()
	{
		$this->assertTrue(\class_exists('\mjolnir\html\HTMLFormField_Radio'));
	}

	// @todo tests for \mjolnir\html\HTMLFormField_Radio

} # test
