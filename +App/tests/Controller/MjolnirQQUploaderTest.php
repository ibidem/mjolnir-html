<?php namespace mjolnir\html\tests;

use \mjolnir\html\Controller_MjolnirQQUploader;

class Controller_MjolnirQQUploaderTest extends \app\PHPUnit_Framework_TestCase
{
	/** @test */ function
	can_be_loaded()
	{
		$this->assertTrue(\class_exists('\mjolnir\html\Controller_MjolnirQQUploader'));
	}

	// @todo tests for \mjolnir\html\Controller_MjolnirQQUploader

} # test
