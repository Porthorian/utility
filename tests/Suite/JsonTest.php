<?php

declare(strict_types=1);

namespace Porthorian\Utility\Tests\Suite;

use JsonException;
use PHPUnit\Framework\TestCase;
use Porthorian\Utility\Json\JsonWrapper;

class JsonTest extends TestCase
{
	public function setUp() : void
	{
		$this->assertNull(JsonWrapper::clearErrors());
	}

	public function testJson()
	{
		$encode_me = ['hello_world' => 45, 'number' => false, 'concerned' => [true, true, 5234234, 22, 'yes'], 'random' => 'string'];
		$expected_string = '{"hello_world":45,"number":false,"concerned":[true,true,5234234,22,"yes"],"random":"string"}';
		$this->assertEquals($expected_string, JsonWrapper::json($encode_me));

		$this->assertEmpty(JsonWrapper::json(["\xF0" => '\u0130\u00e7mimarl\u0131k \u0130\u00e7mimar Dilek']));
		$this->assertTrue(JsonWrapper::hasError());
		$this->assertNotEmpty(JsonWrapper::getErrors());
		$this->assertNotEmpty(JsonWrapper::getLastError());

		$this->expectException(JsonException::class);
		JsonWrapper::json(["\xF0" => '\u0130\u00e7mimarl\u0131k \u0130\u00e7mimar Dilek'], JSON_THROW_ON_ERROR);
	}

	public function testDecode()
	{
		$string = '{
		  "number": false,
		  "concerned": [
		    [
		      true,
		      true,
		      -1345170678,
		      -1806578894,
		      false,
		      false
		    ],
		    1480452145,
		    385207366.4723177,
		    true,
		    "proper",
		    true
		  ],
		  "mixture": true,
		  "important": -763369165.4042568,
		  "sign": -1623540759.1403704,
		  "pictured": "melted"
		}';

		$this->assertIsArray(JsonWrapper::decode($string));

		$this->assertNull(JsonWrapper::decode('random_wrong_string'));
		$this->assertTrue(JsonWrapper::hasError());
		$this->assertNotEmpty(JsonWrapper::getLastError());
		$this->assertNotEmpty(JsonWrapper::getErrors());

		$this->expectException(JsonException::class);
		JsonWrapper::decode('throwan error', JSON_THROW_ON_ERROR);
	}
}

