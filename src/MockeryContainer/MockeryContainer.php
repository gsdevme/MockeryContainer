<?php
declare(strict_types = 1);

namespace MockeryContainer;

use Doctrine\Common\Collections\ArrayCollection;
use MockeryContainer\Exception\NotFoundException;
use Mockery\MockInterface;
use Psr\Container\ContainerInterface;

class MockeryContainer implements ContainerInterface, MockeryContainerInterface
{
    use MockeryContainerMockTrait;

    /**
     * @var ArrayCollection
     */
    private $services;

    public function __construct()
    {
        $this->services = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        $service = $this->services->get($id);

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
        return $this->services->containsKey($id);
    }

    /**
     * {@inheritdoc}
     */
    public function mock(string $id, ...$args): MockInterface
    {
        // TODO: Implement mock() method.
    }
}
