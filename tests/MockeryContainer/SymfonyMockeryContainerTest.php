<?php

namespace Tests\MockeryContainer;

use MockeryContainer\MockeryContainerInterface;
use MockeryContainer\SymfonyMockeryContainer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;
use Mockery;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

class SymfonyMockeryContainerTest extends TestCase
{
    /**
     * @var SymfonyMockeryContainer
     */
    private $container;

    public function setUp()
    {
        $this->container = new SymfonyMockeryContainer();
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf(MockeryContainerInterface::class, $this->container);
        $this->assertInstanceOf(Container::class, $this->container);
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
        $this->expectException(ServiceNotFoundException::class);

        $this->container->get('missing-service-id');
    }
}
