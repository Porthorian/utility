<?php

declare(strict_types=1);

namespace Porthorian\Utility\Time;

use DateInterval;
use DateTime;

class TimeUtil
{
	/**
	 * @see https://www.php.net/manual/en/class.dateinterval.php
	 * @param $start_date - Ex: 2022-04-19 12:55:00
	 * @param $end_date - Ex 2022-09-20 14:16:00
	 * @return DateInterval
	 */
	public static function getAge(string $start_date, string $end_date) : DateInterval
	{
		return (new DateTime($start_date))->diff(new DateTime($end_date));
	}
}
