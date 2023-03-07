<?php

namespace Pingpress\Controller;

use Inc\Service\ContainerService;
use Psr\Container\ContainerInterface;

if (! defined('ABSPATH')) {
    exit;
}

abstract class AbstractController
{    
    /**
     * get
     * Retourne la valeur contenue dans le container
     *
     * @param  string $name
     * @return mixed
     */
    public function get(string $name): mixed
    {
        /** @var ContainerInterface $container */
        $container = ContainerService::getContainer();
        if ($container->has($name)) {
            return $container->get($name);
        }

        return null;
    }
}
