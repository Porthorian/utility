<?php

declare(strict_types=1);

namespace Porthorian\Utility\Tests\Suite;

use ReflectionClass;
use PHPUnit\Framework\TestCase;
use Porthorian\Utility\Metadata\ClassMetadata;
use Porthorian\Utility\Tests\TestMetadata;

class MetadataTest extends TestCase
{
	public function testGetReflection()
	{
		$meta = new ClassMetadata(new TestMetadata());

		$this->assertInstanceOf(ReflectionClass::class, $meta->getReflection());
	}
	public function testGetPublicFields()
	{
		$meta = new ClassMetadata(new TestMetadata());
		$this->assertEquals(['public_string'], $meta->getPublicFields());
	}

	public function testGetProtectedFields()
	{
		$meta = new ClassMetadata(new TestMetadata());
		$this->assertEquals(['protected_string'], $meta->getProtectedFields());
	}

	public function testGetPrivateFields()
	{
		$meta = new ClassMetadata(new TestMetadata());
		$this->assertEquals(['private_string'], $meta->getPrivateFields());
	}
}
