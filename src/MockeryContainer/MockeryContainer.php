<?php
declare(strict_types = 1);

namespace MockeryContainer;

use Mockery\MockInterface;
use MockeryContainer\Exception\NotFoundException;
use MockeryContainer\Registry\MockRegistry;
use Psr\Container\ContainerInterface;

class MockeryContainer implements ContainerInterface, MockeryContainerInterface
{
    /**
     * @var MockRegistry
     */
    private $mockRegistry;

    public function __construct()
    {
        $this->mockRegistry = new MockRegistry();
    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        $service = $this->mockRegistry->get($id);

        if (null === $service) {
            throw new NotFoundException(sprintf('Service %s not found within the container', $id));
        }

        return $service;
    }

    /**
     * {@inheritdoc}
     */
    public function has($id): bool
    {
        return $this->mockRegistry->has($id);
    }

    /**
     * {@inheritdoc}
     */
    public function mock(string $id, ...$args): MockInterface
    {
        $mock = call_user_func_array([\Mockery::class, 'mock'], $args);
        $this->mockRegistry->set($id, $mock);

        return $mock;
    }

    /**
     * {@inheritdoc}
     */
    public function __destruct()
    {
        unset($this->mockRegistry);
    }
}
