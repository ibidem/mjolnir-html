<?php namespace mjolnir\html\tests;

use \mjolnir\html\HTMLFormField_VideoUploader;

class HTMLFormField_VideoUploaderTest extends \app\PHPUnit_Framework_TestCase
{
	/** @test */ function
	can_be_loaded()
	{
		$this->assertTrue(\class_exists('\mjolnir\html\HTMLFormField_VideoUploader'));
	}

	// @todo tests for \mjolnir\html\HTMLFormField_VideoUploader

} # test
