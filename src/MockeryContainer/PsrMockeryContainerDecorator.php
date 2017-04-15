<?php
declare(strict_types = 1);

namespace MockeryContainer;

use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class PsrMockeryContainerDecorator implements ContainerInterface, MockeryContainerInterface
{
    use MockeryContainerTrait;

    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->mockeryContainer = new MockeryContainer();
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        try {
            $service = $this->mockeryContainer->get($id);
        } catch (NotFoundExceptionInterface $e) {
            $service = $this->container->get($id);
        }

        return $service;
    }

    /**
     * {@inheritdoc}
     */
    public function has($id): bool
    {
        if ($this->mockeryContainer->has($id)) {
            return true;
        }

        return $this->container->has($id);
    }
}
