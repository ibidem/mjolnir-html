<?php namespace mjolnir\html\tests;

use \mjolnir\html\HTMLFormField_Hidden;

class HTMLFormField_HiddenTest extends \PHPUnit_Framework_TestCase
{
	/** @test */ function
	can_be_loaded()
	{
		$this->assertTrue(\class_exists('\mjolnir\html\HTMLFormField_Hidden'));
	}

	// @todo tests for \mjolnir\html\HTMLFormField_Hidden

} # test
