<?php

declare(strict_types=1);

namespace Porthorian\Utility\Tests\Suite;

use PHPUnit\Framework\TestCase;
use Porthorian\Utility\Key\Generator;

class KeyTest extends TestCase
{
	public function testGenerateToken()
	{
		$random_string = Generator::generateToken();
		$this->assertNotEmpty($random_string);
		$this->assertEquals(12, strlen($random_string));
		$this->assertNotEquals($random_string, Generator::generateToken());

		$length = 45;
		$random_string = Generator::generateToken($length);
		$this->assertNotEmpty($random_string);
		$this->assertEquals($length, strlen($random_string));
		$this->assertNotEquals($random_string, Generator::generateToken($length));
	}

	public function testGenerateMD5Token()
	{
		$md5 = Generator::generateMD5Token();
		$this->assertTrue(preg_match('/^[a-f0-9]{32}$/', $md5) === 1);
	}
}