<?php
declare(strict_types = 1);

namespace MockeryContainer;

use Mockery;
use Mockery\MockInterface;
use MockeryContainer\Registry\MockRegistry;

trait MockeryContainerMockTrait
{
    /**
     * @var MockRegistry
     */
    private $mockRegistry;

    /**
     * {@inheritdoc}
     */
    public function mock(string $id, ...$args): MockInterface
    {
        $mock = call_user_func_array([Mockery::class, 'mock'], $args);
        $this->mockRegistry->set($id, $mock);

        return $mock;
    }

    public function __destruct()
    {
        unset($this->mockRegistry);
    }
}
