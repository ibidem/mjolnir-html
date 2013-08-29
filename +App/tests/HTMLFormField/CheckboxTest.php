<?php namespace mjolnir\html\tests;

use \mjolnir\html\HTMLFormField_Checkbox;

class HTMLFormField_CheckboxTest extends \app\PHPUnit_Framework_TestCase
{
	/** @test */ function
	can_be_loaded()
	{
		$this->assertTrue(\class_exists('\mjolnir\html\HTMLFormField_Checkbox'));
	}

	// @todo tests for \mjolnir\html\HTMLFormField_Checkbox

} # test
