<?php

declare(strict_types=1);

namespace Doctrine\Tests\Persistence\Mapping;

use Doctrine\Persistence\Mapping\ClassMetadata;
use Doctrine\Persistence\Mapping\Driver\StaticPHPDriver;
use Doctrine\Tests\DoctrineTestCase;
use PHPUnit\Framework\MockObject\MockObject;

class StaticPHPDriverTest extends DoctrineTestCase
{
    public function testLoadMetadata() : void
    {
        /** @var ClassMetadata|MockObject $metadata */
        $metadata = $this->createMock(ClassMetadata::class);
        $metadata->expects(self::once())->method('getFieldNames');

        $driver = new StaticPHPDriver([__DIR__]);
        $driver->loadMetadataForClass(TestEntity::class, $metadata);
    }

    public function testGetAllClassNames() : void
    {
        $driver     = new StaticPHPDriver([__DIR__]);
        $classNames = $driver->getAllClassNames();

        self::assertContains(TestEntity::class, $classNames);
    }
}

class TestEntity
{
    public static function loadMetadata(ClassMetadata $metadata) : void
    {
        $metadata->getFieldNames();
    }
}
