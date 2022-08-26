<?php

declare(strict_types=1);

namespace Porthorian\Utility\Tests\Suite;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Porthorian\Utility\Cache\RequestCache;

class CacheTest extends TestCase
{
	public function setUp() : void
	{
		$this->assertNull(RequestCache::resetCache());
	}

	public function testSetCacheItem()
	{
		RequestCache::setCacheItem('hello', 'world');

		$this->assertEquals('world', RequestCache::getCacheItem('hello'));

		RequestCache::setCacheItem('hello', 1);
		$this->assertEquals(1, RequestCache::getCacheItem('hello'));

		RequestCache::setCacheItem('hello', ['world']);
		$this->assertEquals(['world'], RequestCache::getCacheItem('hello'));

		RequestCache::setCacheItem('hello', 4.25);
		$this->assertEquals(4.25, RequestCache::getCacheItem('hello'));

		$this->expectException(InvalidArgumentException::class);
		$this->expectExceptionMessage('Value can not be a null value.');
		RequestCache::setCacheItem('dsfsf', null);
	}

	public function testSetCacheItemIfNotSet()
	{
		RequestCache::setCacheItem('hello', 'world');
		$this->assertEquals('world', RequestCache::getCacheItem('hello'));

		RequestCache::setCacheItemIfNotSet('hello', 'new world');
		$this->assertEquals('world', RequestCache::getCacheItem('hello'));

		RequestCache::deleteCacheItem('hello');

		$this->assertFalse(RequestCache::hasCacheItem('hello'));
		RequestCache::setCacheItemIfNotSet('hello', 'new world');
		$this->assertEquals('new world', RequestCache::getCacheItem('hello'));
	}
}
