# Basic Usage

A very basic usage showing how something can be mocked and used to test.

```php
<?php

use MockeryContainer\MockeryContainer;
use Psr\Container\ContainerInterface;

class UserRepository
{
    public function findAll(): array
    {
        return ['realUserA', 'realUserB'];    
    }
}

$container = new MockeryContainer();
$mock = $container->mock('user_repository', UserRepository::class);

$mock->shouldReceive('findAll')->andReturn(['userA', 'userB']);

function getAllUsers(ContainerInterface $container) {
    return $container->get('user_repository')->findAll();
}

$users = getAllUsers($container);
```
