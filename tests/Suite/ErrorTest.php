<?php

declare(strict_types=1);

namespace Porthorian\Utility\Tests\Suite;

use PHPUnit\Framework\TestCase;
use Porthorian\Utility\Tests\TestError;

class ErrorTest extends TestCase
{
	public function testGetError()
	{
		$error = new TestError();
		$this->assertEmpty($error->getError());
		$this->assertEmpty($error->getInternalError());

		$this->assertNull($error->addTestError('I am a new error'));

		$this->assertNotEmpty($error->getError());
		$this->assertEmpty($error->getInternalError());
	}

	public function testGetInternalError()
	{
		$error = new TestError();
		$this->assertEmpty($error->getInternalError());
		$this->assertEmpty($error->getError());

		$this->assertNull($error->addTestInternalError('I am a new error'));

		$this->assertNotEmpty($error->getInternalError());
		$this->assertEmpty($error->getError());
	}

	public function testHasError()
	{
		$error = new TestError();

		$this->assertFalse($error->hasError());
		$this->assertNull($error->addTestError('I am an error'));
		$this->assertTrue($error->hasError());
	}

	public function testHasInternalError()
	{
		$error = new TestError();

		$this->assertFalse($error->hasInternalError());
		$this->assertNull($error->addTestInternalError('I am an error'));
		$this->assertTrue($error->hasInternalError());
	}
}
