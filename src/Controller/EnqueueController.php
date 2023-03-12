<?php

namespace Pingpress\Controller;

if (! defined('ABSPATH')) {
    exit;
}

final class EnqueueController extends AbstractController
{
    public function __invoke()
    {
        if (is_admin()) {
            $enqueueService = $this->get('enqueue.service');
            add_action('admin_print_styles', [$enqueueService, 'registerAssets']);
            add_action('admin_print_styles', [$enqueueService, 'registerScript'], 9);
        }
    }
}
