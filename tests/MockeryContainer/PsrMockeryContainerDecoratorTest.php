<?php

namespace Tests\MockeryContainer;

use MockeryContainer\Exception\NotFoundException;
use MockeryContainer\MockeryContainerInterface;
use MockeryContainer\PsrMockeryContainerDecorator;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Mockery;
use Psr\Container\NotFoundExceptionInterface;

class PsrMockeryContainerDecoratorTest extends TestCase
{
    /**
     * @var SymfonyMockeryContainer
     */
    private $container;

    /**
     * @var Mockery\MockInterface|ContainerInterface
     */
    private $psrContainer;

    public function setUp()
    {
        $this->psrContainer = Mockery::mock(ContainerInterface::class);
        $this->container = new PsrMockeryContainerDecorator($this->psrContainer);
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

    public function testGetOnServiceInPSRContainer()
    {
        $this->psrContainer->shouldReceive('get')->withArgs(['psr-service'])->andReturn(new \stdClass());

        $service = $this->container->get('psr-service');

        $this->assertInstanceOf(\stdClass::class, $service);
    }

    public function testHasReturnsFalseOnMissingService()
    {
        $this->psrContainer->shouldReceive('has')->andReturn(false);

        $this->assertFalse($this->container->has('missing-service'));
    }

    public function testHasReturnsTrueOnExistingService()
    {
        $this->container->mock('service', \stdClass::class);

        $this->assertTrue($this->container->has('service'));
    }

    public function testGetOnMissingService()
    {
        $this->psrContainer->shouldReceive('get')->andThrow(NotFoundException::class);

        $this->expectException(NotFoundExceptionInterface::class);

        $this->container->get('missing-service-id');
    }
}
