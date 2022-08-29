<?php

declare(strict_types=1);

namespace Porthorian\Utility\Error;

use InvalidArgumentException;

trait ErrorTrait
{
	/**
	 * Stores user viewable errors.
	 */
	private array $error = [];

	/**
	 * Stores internal viewable errors.
	 */
	private array $error_internal = [];

	////
	// Final Public Routines
	////

	final public function getError() : array
	{
		return $this->error;
	}

	final public function getInternalError() : array
	{
		return $this->error_internal;
	}

	final public function clearErrors() : void
	{
		$this->error = [];
	}

	final public function clearInternalErrors() : void
	{
		$this->error_internal = [];
	}

	final public function clearAllErrors() : void
	{
		$this->clearErrors();
		$this->clearInternalErrors();
	}

	////
	// Public Routines
	////

	public function hasError() : bool
	{
		return !empty($this->getError());
	}

	public function hasInternalError() : bool
	{
		return !empty($this->getInternalError());
	}

	/**
	 * Get all user facing errors.
	 * @see formatError
	 * @param $type - What format should be outputted.
	 * @return string.
	 */
	public function getErrors(string $type = 'text') : string
	{
		return $this->formatError($this->error, $type);
	}

	public function getLastError() : string
	{
		$error = $this->error[count($this->error) - 1];
		return $error !== false ? $error['message'] : 'Unknown Error';
	}

	public function getLastErrorCode() : int
	{
		$error = $this->error[count($this->error) - 1];
		return $error !== false ? $error['code'] : 0;
	}

	/**
	 * Get all internal facing errors.
	 * @see formatError
	 * @param $type - What format should be outputted.
	 * @return string.
	 */
	public function getInternalErrors(string $type = 'text') : string
	{
		return $this->formatError($this->error_internal, $type);
	}

	public function getLastInternalError() : string
	{
		$error = $this->error_internal[count($this->error_internal) - 1];
		return $error !== false ? $error['message'] : 'Unknown Error';
	}

	public function getLastInternalErrorCode() : int
	{
		$error = $this->error_internal[count($this->error_internal) - 1];
		return $error !== false ? $error['code'] : 0;
	}

	////
	// Final Protected Routines
	////

	final protected function setError(array $error) : void
	{
		$this->error = $error;
	}

	final protected function setInternalError(array $error_internal) : void
	{
		$this->error_internal = $error_internal;
	}

	////
	// Protected Routines
	////

	protected function addError(string $message, int $error_code = 0) : void
	{
		$this->error[] = ['message' => $message, 'code' => $error_code];
	}

	protected function addInternalError(string $message, int $error_code = 0) : void
	{
		$this->error_internal[] = ['message' => $message, 'code' => $error_code];
	}

	////
	// Private Routines
	////

	/**
	 * @param $error_array - What error array are we formatting?
	 * @param $type - How should we format the error?
	 * @return string
	 */
	private function formatError(array $error_array, string $type) : string
	{
		switch ($type)
		{
			case 'text':
			return implode(', ', array_map(function ($item) {
				return $item['message'];
			}, $error_array));

			default:
			throw new InvalidArgumentException('Format error invalid type specified: '.$type);
		}
	}
}
