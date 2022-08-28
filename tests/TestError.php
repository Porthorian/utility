<?php

declare(strict_types=1);

namespace Porthorian\Utility\Tests;

use Porthorian\Utility\Error\HandlerTrait;

class TestError
{
	use HandlerTrait;

	public function addTestError(string $message, int $code = 0) : void
	{
		$this->addError($message, $code);
	}

	public function addTestInternalError(string $message, int $code = 0) : void
	{
		$this->addInternalError($message, $code);
	}
}
