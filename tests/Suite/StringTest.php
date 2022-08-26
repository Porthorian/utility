<?php

declare(strict_types=1);

namespace Porthorian\Utility\Tests\Suite;

use PHPUnit\Framework\TestCase;
use Porthorian\Utility\String\StringUtility;

class StringTest extends TestCase
{
	public function testCamelCase()
	{
		$string = 'hello_world';
		$this->assertEquals('helloWorld', StringUtility::camelCase($string));
		$this->assertEquals('HelloWorld', StringUtility::camelCase($string, '_', true));


		$string = 'hello-world';
		$this->assertEquals('helloWorld', StringUtility::camelCase($string, '-'));
		$this->assertEquals('HelloWorld', StringUtility::camelCase($string, '-', true));
	}

	public function testHumanReadable()
	{
		$string = 'hello_world_this_is_my_world';

		$expected_string = 'Hello World This Is My World';
		$this->assertEquals($expected_string, StringUtility::humanReadable($string));

		$string = 'hello\world\this\is\my\world';
		$this->assertEquals($expected_string, StringUtility::humanReadable($string, '\\'));
	}

	public function testHtmlEncode()
	{
		$string = "<script>alert('hello')</script>";
		$expected_string = "&lt;script&gt;alert(&#039;hello&#039;)&lt;/script&gt;";
		$this->assertEquals($expected_string, StringUtility::htmlEncode($string));
	}
}
