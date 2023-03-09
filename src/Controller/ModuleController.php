<?php

namespace Pingpress\Controller;

use Inc\Service\ContainerService;

if (! defined('ABSPATH')) {
    exit;
}

final class ModuleController extends AbstractController
{
    public function __invoke()
    {
        if (is_admin()) {
            $moduleService = $this->get('module.service');
            add_action('admin_menu', [$moduleService, 'registerSubpageAdminMenu']);
        }
    }
}
