<?php namespace mjolnir\html\tests;

use \mjolnir\html\HTMLForm;

class HTMLFormTest extends \PHPUnit_Framework_TestCase
{
	/** @test */ function
	can_be_loaded()
	{
		$this->assertTrue(\class_exists('\mjolnir\html\HTMLForm'));
	}

	// @todo tests for \mjolnir\html\HTMLForm

} # test
