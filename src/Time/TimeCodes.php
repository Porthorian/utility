<?php

declare(strict_types=1);

namespace Porthorian\Utility\Time;

class TimeCodes
{
	public const ONE_MIN = 60;
	public const ONE_HOUR = self::ONE_MIN * 60;
	public const ONE_DAY = self::ONE_HOUR * 24;
	public const ONE_WEEK = self::ONE_DAY * 7;
	public const ONE_MONTH = self::ONE_WEEK * 4.345;
	public const ONE_YEAR = self::ONE_MONTH * 12;

	public const DATEFORMAT_STANDARD = 'Y-m-d H:i:s';
	public const DATEFORMAT_COMPACT = 'Y-m-d';
	public const DATE_ZERO = '0000-00-00 00:00:00';
	public const DATE_HALF_ZERO = '0000-00-00';
}
