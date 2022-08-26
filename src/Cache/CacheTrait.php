<?php

declare(strict_types=1);

namespace Porthorian\Utility\Cache;

use InvalidArgumentException;

trait CacheTrait
{
	private static array $cache = [];

	/**
	* @param $key - the key that is stored inside static prop $cache
	* @param $value - mixed, this can be anything you want.
	* @return void
	*/
	public static function setCacheItem(string $key, mixed $value) : void
	{
		if ($value === null)
		{
			throw new InvalidArgumentException('Value can not be a null value.');
		}

		self::$cache[$key] = $value;
	}

	/**
	 * Will not add item if something already exists there.
	 * @see addCacheItem
	 */
	public static function setCacheItemIfNotSet(string $key, mixed $value) : void
	{
		if (self::hasCacheItem($key))
		{
			return;
		}

		self::setCacheItem($key, $value);
	}

	/**
	 * @return mixed|null when the key doesn't exist.
	 */
	public static function getCacheItem(string $key) : mixed
	{
		return self::$cache[$key] ?? null;
	}

	/**
	 * Does the cache item exist?
	 * @return bool
	 */
	public static function hasCacheItem(string $key) : bool
	{
		return isset(self::$cache[$key]);
	}

	/**
	* Removes cache item from static prop
	*/
	public static function deleteCacheItem(string $key) : void
	{
		unset(self::$cache[$key]);
	}

	/**
	* Clears entire cache.
	*/
	public static function resetCache() : void
	{
		self::$cache = [];
	}
}
