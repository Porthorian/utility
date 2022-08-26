<?php

declare(strict_types=1);

namespace Porthorian\Utility\Json;

class JsonWrapper
{
	private static array $errors = [];

	public static function json(array $array, int $flags = 0, int $depth = 512) : string
	{
		$json = json_encode($array, $flags, $depth);
		if ($json === false)
		{
			static::$errors[] = json_last_error_msg();
			return '';
		}
		return $json;
	}

	/**
	 * @return - associative array or null on failure.
	 */
	public static function decode(string $json, int $flags = 0, int $depth = 512,) : ?array
	{
		$decode = json_decode($json, true, $depth, $flags);
		if (json_last_error() !== JSON_ERROR_NONE)
		{
			static::$errors[] = json_last_error_msg();
			return null;
		}
		return $decode;
	}

	public static function hasError() : bool
	{
		return count(static::getErrors()) >= 1;
	}

	public static function getErrors() : array
	{
		return static::$errors;
	}

	public static function getLastError() : string
	{
		$error = end(static::$errors);
		return $error !== false ? $error : '';
	}

	public static function clearErrors() : void
	{
		static::$errors = [];
	}
}
