<?php namespace mjolnir\html\tests;

use \mjolnir\html\HTMLFormField_Textarea;

class HTMLFormField_TextareaTest extends \app\PHPUnit_Framework_TestCase
{
	/** @test */ function
	can_be_loaded()
	{
		$this->assertTrue(\class_exists('\mjolnir\html\HTMLFormField_Textarea'));
	}

	// @todo tests for \mjolnir\html\HTMLFormField_Textarea

} # test
