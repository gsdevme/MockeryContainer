# MockeryContainer


## Description

This library provides a PSR-11 MockContainer for use in testing environments, along with a PSR-11 Container decorator and Symfony Container

## Usage
```php
<?php

use MockeryContainer\MockeryContainer;
use Psr\Container\ContainerInterface;
use Mockery;
use UserRepository;

$container = new MockeryContainer();
$mock = $container->mock('user_repository', UserRepository::class);

$mock->shouldReceive('findAll')->andReturn(['userA', 'userB']);

function getAllUsers(ContainerInterface $container) {
    return $container->get('user_repository')->findAll();
}

$users = getAllUsers($container);
```

## Symfony

todo
