<?php
declare(strict_types = 1);

namespace MockeryContainer\Registry;

use Doctrine\Common\Collections\ArrayCollection;
use Mockery\MockInterface;

class MockRegistry
{
    /**
     * @var ArrayCollection
     */
    private $mocks;

    public function __construct()
    {
        $this->mocks = new ArrayCollection();
    }

    public function get(string $id): ?MockInterface
    {
        return $this->mocks->get($id);
    }

    public function set(string $id, MockInterface $mock): void
    {
        $this->mocks->set($id, $mock);
    }

    public function has(string $id): bool
    {
        return $this->mocks->containsKey($id);
    }

    public function __destruct()
    {
        \Mockery::close();
    }
}
