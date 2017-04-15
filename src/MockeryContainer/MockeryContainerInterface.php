<?php
declare(strict_types = 1);

namespace MockeryContainer;

use Mockery\MockInterface;
use Psr\Container\ContainerInterface;

interface MockeryContainerInterface extends ContainerInterface
{
    /**
     * @param string $id
     * @param $args
     * @return MockInterface
     */
    public function mock(string $id, ...$args): MockInterface;
}
