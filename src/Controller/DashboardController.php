<?php

namespace Pingpress\Controller;

if (! defined('ABSPATH')) {
    exit;
}

final class DashboardController extends AbstractController
{
    public function __invoke()
    {
        if (is_admin()) {
            $dashboardService = $this->get('dashboard.service');
            add_action('admin_menu', [$dashboardService, 'registerPage']);
        }
    }
}
