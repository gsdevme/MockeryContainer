<?php
declare(strict_types = 1);

namespace MockeryContainer;

use Mockery\MockInterface;
use MockeryContainer\Exception\NotFoundException;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class SymfonyMockeryContainer extends Container implements MockeryContainerInterface
{
    private $mockeryContainer;

    /**
     * @param ParameterBagInterface|null $parameterBag
     */
    public function __construct(ParameterBagInterface $parameterBag = null)
    {
        $this->mockeryContainer = new MockeryContainer();

        parent::__construct($parameterBag);
    }

    /**
     * {@inheritdoc}
     */
    public function get($id, $invalidBehavior = self::EXCEPTION_ON_INVALID_REFERENCE)
    {
        try {
            $service = $this->mockeryContainer->get($id);
        } catch (NotFoundException $e) {
            $service = parent::get($id);
        }

        return $service;
    }

    /**
     * {@inheritdoc}
     */
    public function has($id)
    {
        if ($this->mockeryContainer->has($id)) {
            return true;
        }

        return parent::has($id);
    }

    /**
     * {@inheritdoc}
     */
    public function mock(string $id, ...$args): MockInterface
    {
        array_unshift($args, $id);

        return call_user_func_array([$this->mockeryContainer, 'mock'], $args);
    }
}
