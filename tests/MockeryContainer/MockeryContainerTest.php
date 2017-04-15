<?php

namespace Tests\MockeryContainer;

use MockeryContainer\MockeryContainer;
use MockeryContainer\MockeryContainerInterface;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Mockery;

class MockeryContainerTest extends TestCase
{
    /**
     * @var MockeryContainer
     */
    private $container;

    public function setUp()
    {
        $this->container = new MockeryContainer();
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf(MockeryContainerInterface::class, $this->container);
        $this->assertInstanceOf(ContainerInterface::class, $this->container);
    }

    public function testGetOnService()
    {
        $this->container->mock('service123', \stdClass::class);

        $service = $this->container->get('service123');

        $this->assertInstanceOf(\stdClass::class, $service);
    }

    public function testHasReturnsFalseOnMissingService()
    {
        $this->assertFalse($this->container->has('missing-service'));
    }

    public function testHasReturnsTrueOnExistingService()
    {
        $this->container->mock('service', \stdClass::class);

        $this->assertTrue($this->container->has('service'));
    }

    public function testGetOnMissingService()
    {
        $this->expectException(NotFoundExceptionInterface::class);

        $this->container->get('missing-service-id');
    }
}
