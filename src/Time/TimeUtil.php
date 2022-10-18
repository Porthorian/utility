<?php

declare(strict_types=1);

namespace Porthorian\Utility\Time;

use DateInterval;
use DateTime;
use DateTimeZone;

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

	/**
	 * @see https://www.php.net/manual/en/class.dateinterval.php
	 */
	public static function ago(string $timestamp, bool $abbreviated = false, string $timezone = 'UTC') : string
	{
		$now = new DateTime();
		$date = new DateTime($timestamp, new DateTimeZone($timezone));

		$diff = $now->diff($date);

		$week = (int)floor($diff->d / 7);
		$difference = [
			'y' => $diff->y,
			'm' => $diff->m,
			'w' => $week,
			'd' => $diff->d - $week * 7,
			'h' => $diff->h,
			'i' => $diff->i,
			's' => $diff->s
		];

		/**
		 * These keys match the difference array set.
		 * w is 1 we set.
		 */
		$string = [
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		];

		foreach ($string as $key => &$value)
		{
			if ($difference[$key] <= 0)
			{
				unset($string[$key]);
				continue;
			}
			$value = $difference[$key] . ' ' . $value . ($difference[$key] > 1 ? 's' : '');
		}

		if (!$abbreviated) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
}
