<?php

namespace Tests\MockeryContainer;

use MockeryContainer\MockeryContainerInterface;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use MockeryContainer\SymfonyMockeryContainer;
use Symfony\Component\DependencyInjection\Container;

class SymfonyMockeryContainerTest extends MockeryTestCase
{
    private $mockeryContainer;

    public function setUp()
    {
        $this->mockeryContainer = new SymfonyMockeryContainer();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf(MockeryContainerInterface::class, $this->mockeryContainer);
        $this->assertInstanceOf(Container::class, $this->mockeryContainer);
    }
}
