<?php

declare(strict_types=1);

namespace Porthorian\Utility\Key;

class Generator
{
	/**
	 * Generate a random set of characters
	 * @return string
	 */
	public static function generateToken(int $length = 12) : string
	{
		return substr(bin2hex(random_bytes($length)), 0, $length);
	}

	/**
	 * Generate a randomized md5 token
	 * @return string
	 */
	public static function generateMD5Token(int $iteration = 45) : string
	{
		return md5(self::generateToken($iteration));
	}
}
