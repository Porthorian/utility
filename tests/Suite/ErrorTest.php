<?php

declare(strict_types=1);

namespace Porthorian\Utility\Tests\Suite;

use InvalidArgumentException;
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

	public function testGetErrors()
	{
		$error = new TestError();

		$error->addTestError('I am an error');
		$error->addTestError('I am a new error', 45);

		$this->assertEquals('I am an error, I am a new error', $error->getErrors());
		$this->assertEquals('I am a new error', $error->getLastError());
		$this->assertEquals(45, $error->getLastErrorCode());

		$this->expectException(InvalidArgumentException::class);
		$error->getErrors('wrong_type');
	}

	public function testGetInternalErrors()
	{
		$error = new TestError();

		$error->addTestInternalError('I am an internal error');
		$error->addTestInternalError('I am a new internal error', 65);

		$this->assertEquals('I am an internal error, I am a new internal error', $error->getInternalErrors());
		$this->assertEquals('I am a new internal error', $error->getLastInternalError());
		$this->assertEquals(65, $error->getLastInternalErrorCode());

		$this->expectException(InvalidArgumentException::class);
		$error->getInternalErrors('sdfndsjfnsdfs dsdfsdfdsf');
	}

	public function testSetAndClearErrors()
	{
		$error = new TestError();

		$error->addTestError('I am an error');
		$error->addTestInternalError('I am an internal error');

		$this->assertTrue($error->hasError());
		$this->assertTrue($error->hasInternalError());

		$error->clearAllErrors();

		$this->assertFalse($error->hasError());
		$this->assertFalse($error->hasInternalError());

		$error->testSetError([['message' => 'new error', 'code' => 45]]);
		$error->testSetErrorInternal([['message' => 'internal error', 'code' => 500]]);

		$this->assertTrue($error->hasError());
		$this->assertTrue($error->hasInternalError());

		$this->assertEquals('new error', $error->getLastError());
		$this->assertEquals(45, $error->getLastErrorCode());
		$this->assertEquals('internal error', $error->getLastInternalError());
		$this->assertEquals(500, $error->getLastInternalErrorCode());
	}
}
