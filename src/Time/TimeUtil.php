<?php

declare(strict_types=1);

namespace Porthorian\Utility\Time;

use DateInterval;
use DateTime;

class TimeUtil
{
	public static function getAge(string $start_date, string $end_date) : DateInterval
	{
		return (new DateTime($start_date))->diff(new DateTime($end_date));
	}
}
