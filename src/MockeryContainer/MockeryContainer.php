<?php
declare(strict_types = 1);

namespace MockeryContainer;

use MockeryContainer\Exception\NotFoundException;
use MockeryContainer\Registry\MockRegistry;
use Psr\Container\ContainerInterface;

class MockeryContainer implements ContainerInterface, MockeryContainerInterface
{
    use MockeryContainerMockTrait;

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
}
