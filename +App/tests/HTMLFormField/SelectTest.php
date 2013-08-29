<?php namespace mjolnir\html\tests;

use \mjolnir\html\HTMLFormField_Select;

class HTMLFormField_SelectTest extends \app\PHPUnit_Framework_TestCase
{
	/** @test */ function
	can_be_loaded()
	{
		$this->assertTrue(\class_exists('\mjolnir\html\HTMLFormField_Select'));
	}

	// @todo tests for \mjolnir\html\HTMLFormField_Select

} # test
