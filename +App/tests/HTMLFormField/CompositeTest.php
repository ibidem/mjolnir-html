<?php namespace mjolnir\html\tests;

use \mjolnir\html\HTMLFormField_Composite;

class HTMLFormField_CompositeTest extends \app\PHPUnit_Framework_TestCase
{
	/** @test */ function
	can_be_loaded()
	{
		$this->assertTrue(\class_exists('\mjolnir\html\HTMLFormField_Composite'));
	}

	// @todo tests for \mjolnir\html\HTMLFormField_Composite

} # test
