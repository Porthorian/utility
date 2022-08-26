<?php

declare(strict_types=1);

namespace Porthorian\Utility\String;

class StringUtility
{
	public static function camelCase(string $string, string $delimiter = '_', bool $capitalize_first_char = false) : string
	{
		$str = str_replace($delimiter, '', ucwords($string, $delimiter));

		if (!$capitalize_first_char)
		{
			$str = lcfirst($str);
		}

		return $str;
	}

	public static function humanReadable(string $string, string $delimiter = '_') : string
	{
		return ucwords(str_replace($delimiter, ' ', $string));
	}

	public static function htmlEncode(string $string) : string
	{
		return htmlspecialchars($string, ENT_QUOTES);
	}
}
