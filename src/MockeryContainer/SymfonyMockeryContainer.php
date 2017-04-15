<?php
declare(strict_types = 1);

namespace MockeryContainer;

use Mockery\MockInterface;
use MockeryContainer\Registry\MockRegistry;
use Symfony\Component\DependencyInjection\Container;

/**
 * Due to how Symfony will 'compile' this we need to use a static
 */
class SymfonyMockeryContainer extends Container implements MockeryContainerInterface
{
    private static $mockRegistry;

    /**
     * {@inheritdoc}
     */
    public function get($id, $invalidBehavior = self::EXCEPTION_ON_INVALID_REFERENCE)
    {
        if (self::getMockRegistry()->has($id)) {
            return self::getMockRegistry()->get($id);
        }

        return parent::get($id);
    }

    /**
     * {@inheritdoc}
     */
    public function has($id)
    {
        if (self::getMockRegistry()->has($id)) {
            return true;
        }

        return parent::has($id);
    }

    /**
     * {@inheritdoc}
     */
    public function mock(string $id, ...$args): MockInterface
    {
        $mock = call_user_func_array([\Mockery::class, 'mock'], $args);
        self::getMockRegistry()->set($id, $mock);

        return $mock;
    }

    private static function getMockRegistry(): MockRegistry
    {
        if (null === self::$mockRegistry) {
            self::$mockRegistry = new MockRegistry();
        }

        return self::$mockRegistry;
    }

    /**
     * @inheritDoc
     */
    public function __destruct()
    {
        self::$mockRegistry = null;
    }
}
