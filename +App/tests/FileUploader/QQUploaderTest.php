<?php namespace mjolnir\html\tests;

use \mjolnir\html\FileUploader_QQUploader;

class FileUploader_QQUploaderTest extends \PHPUnit_Framework_TestCase
{
	/** @test */ function
	can_be_loaded()
	{
		$this->assertTrue(\class_exists('\mjolnir\html\FileUploader_QQUploader'));
	}

	// @todo tests for \mjolnir\html\FileUploader_QQUploader

} # test
