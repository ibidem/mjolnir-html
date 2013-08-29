<?php namespace mjolnir\html\tests;

use \mjolnir\html\HTMLFormField_ImageUploader;

class HTMLFormField_ImageUploaderTest extends \app\PHPUnit_Framework_TestCase
{
	/** @test */ function
	can_be_loaded()
	{
		$this->assertTrue(\class_exists('\mjolnir\html\HTMLFormField_ImageUploader'));
	}

	// @todo tests for \mjolnir\html\HTMLFormField_ImageUploader

} # test
