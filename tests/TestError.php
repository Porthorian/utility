<?php

declare(strict_types=1);

namespace Porthorian\Utility\Tests;

use Porthorian\Utility\Error\ErrorTrait;

class TestError
{
	use ErrorTrait;

	public function addTestError(string $message, int $code = 0) : void
	{
		$this->addError($message, $code);
	}

	public function addTestInternalError(string $message, int $code = 0) : void
	{
		$this->addInternalError($message, $code);
	}

	public function testSetError(array $array)
	{
		$this->setError($array);
	}

	public function testSetErrorInternal(array $array)
	{
		$this->setInternalError($array);
	}
}
