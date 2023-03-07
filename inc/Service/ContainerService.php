<?php

namespace Inc\Service;

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

if (! defined('ABSPATH')) {
    exit;
}

final class ContainerService
{
    private static $container = null;

    public function __construct(private ContainerBuilder $builder)
    {}
    
    /**
     * setConfiguration
     *
     * @param  array $folders
     * @return void
     */
    public function setConfigurations(array $folders): void
    {
        foreach($folders as $folder) {
            if (! file_exists($folder)) {
                continue;
            }

            $files = array_diff(scandir($folder, SCANDIR_SORT_DESCENDING), ['..', '.']);
            foreach($files as $file) {
                $this->builder->addDefinitions($folder . '/' .$file);
            }
        }

        self::$container = $this->builder->build();
    }
    
    /**
     * getContainer
     *
     * @return self
     */
    public static function getContainer(): ContainerInterface
    {
        return self::$container;
    }
}