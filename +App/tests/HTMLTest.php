<?php namespace mjolnir\html\tests;

use \mjolnir\html\HTML;

class HTMLTest extends \app\PHPUnit_Framework_TestCase
{
	/** @test */ function
	can_be_loaded()
	{
		$this->assertTrue(\class_exists('\mjolnir\html\HTML'));
	}

	// @todo tests for \mjolnir\html\HTML

} # test
