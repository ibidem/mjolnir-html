<?php namespace mjolnir\html\tests;

use \mjolnir\html\HTMLFormField;

class HTMLFormFieldTest extends \app\PHPUnit_Framework_TestCase
{
	/** @test */ function
	can_be_loaded()
	{
		$this->assertTrue(\class_exists('\mjolnir\html\HTMLFormField'));
	}

	// @todo tests for \mjolnir\html\HTMLFormField

} # test
