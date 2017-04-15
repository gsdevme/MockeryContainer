<?php

namespace Tests\MockeryContainer\Registry;

use MockeryContainer\Registry\MockRegistry;
use PHPUnit\Framework\TestCase;
use Mockery;

class MockRegistryTest extends TestCase
{
    public function testMocksAreDestroyed()
    {
        $mockeryContainer = Mockery::getContainer();

        $this->assertCount(0, $mockeryContainer->getMocks());

        $mock = Mockery::mock(\stdClass::class);

        $mockRegistry = new MockRegistry();
        $mockRegistry->set('test', $mock);

        $this->assertCount(1, $mockeryContainer->getMocks());

        unset($mockRegistry);

        $this->assertCount(0, $mockeryContainer->getMocks());
    }
}
