<?php namespace mjolnir\html\tests;

use \mjolnir\html\HTMLFormField_Date;

class HTMLFormField_DateTest extends \PHPUnit_Framework_TestCase
{
	/** @test */ function
	can_be_loaded()
	{
		$this->assertTrue(\class_exists('\mjolnir\html\HTMLFormField_Date'));
	}

	// @todo tests for \mjolnir\html\HTMLFormField_Date

} # test
