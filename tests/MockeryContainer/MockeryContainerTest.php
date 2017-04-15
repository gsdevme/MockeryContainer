<?php

namespace Tests\MockeryContainer;

use MockeryContainer\MockeryContainer;
use MockeryContainer\MockeryContainerInterface;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class MockeryContainerTest extends MockeryTestCase
{
    private $mockeryContainer;

    public function setUp()
    {
        $this->mockeryContainer = new MockeryContainer();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf(MockeryContainerInterface::class, $this->mockeryContainer);
    }
}
