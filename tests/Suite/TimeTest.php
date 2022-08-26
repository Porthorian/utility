<?php

declare(strict_types=1);

namespace Porthorian\Utility\Tests\Suite;

use DateInterval;
use PHPUnit\Framework\TestCase;
use Porthorian\Utility\Time\TimeUtil;
use Porthorian\Utility\Time\TimeCodes;

class TimeTest extends TestCase
{
	public function testGetAge()
	{
		$interval = TimeUtil::getAge('1996-04-12', date(TimeCodes::DATEFORMAT_STANDARD, strtotime('2022-08-26')));
		$this->assertInstanceOf(DateInterval::class, $interval);

		$this->assertEquals(26, $interval->y);
	}
}
