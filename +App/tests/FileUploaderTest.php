<?php namespace mjolnir\html\tests;

use \mjolnir\html\FileUploader;

class FileUploaderTest extends \app\PHPUnit_Framework_TestCase
{
	/** @test */ function
	can_be_loaded()
	{
		$this->assertTrue(\class_exists('\mjolnir\html\FileUploader'));
	}

	// @todo tests for \mjolnir\html\FileUploader

} # test
