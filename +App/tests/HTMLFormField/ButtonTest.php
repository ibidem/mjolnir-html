<?php namespace mjolnir\html\tests;

use \mjolnir\html\HTMLFormField_Button;

class HTMLFormField_ButtonTest extends \PHPUnit_Framework_TestCase
{
	/** @test */ function
	can_be_loaded()
	{
		$this->assertTrue(\class_exists('\mjolnir\html\HTMLFormField_Button'));
	}

	// @todo tests for \mjolnir\html\HTMLFormField_Button

} # test
