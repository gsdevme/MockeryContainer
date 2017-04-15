<?php
declare(strict_types = 1);

namespace MockeryContainer;

use Mockery\MockInterface;

interface MockeryContainerInterface
{
    /**
     * @param string $id
     * @param array ...$args
     * @return MockInterface
     */
    public function mock(string $id, ...$args): MockInterface;
}
