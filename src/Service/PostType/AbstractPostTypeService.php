<?php

namespace Pingpress\Service\PostType;

use Inc\Module\PostTypeModule;

if (! defined('ABSPATH')) {
    exit;
}

abstract class AbstractPostTypeService
{
    public function __construct(protected PostTypeModule $customPostTypeModule)
    {
    }

    abstract public function registerCustomPostType(): void;
}