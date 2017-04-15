<?php
declare(strict_types = 1);

namespace MockeryContainer;

use Mockery\MockInterface;

trait MockeryContainerTrait
{
    /**
     * @var MockeryContainerInterface
     */
    private $mockeryContainer;

    /**
     * {@inheritdoc}
     */
    public function mock(string $id, ...$args): MockInterface
    {
        array_unshift($args, $id);

        return call_user_func_array([$this->mockeryContainer, 'mock'], $args);
    }
}
