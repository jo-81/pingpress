<?php

namespace Pingpress\Service;

use Inc\Module\EnqueueModule;

if (! defined('ABSPATH')) {
    exit;
}

/**
 * EnqueueService
 * Enregistrement des scripts et style
 */
final class EnqueueService
{
    public function __construct(private EnqueueModule $enqueueModule)
    {
    }

    /**
     * registerAssets
     *
     * @return void
     */
    public function registerAssets(): void
    {
        $this->enqueueModule->registerCdn('pingpress_admin_style_icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css', [
            'page' => ['pingpress', 'club', 'configuration']
        ]);

        $this->enqueueModule->registerStyle('pingpress_admin_style', '/pingpress/src/public/admin/css/admin.css', [
            'page' => ['pingpress', 'club', 'configuration']
        ]);

        $this->enqueueModule->registerScript('pingpress_admin_script', '/pingpress/src/public/admin/js/admin.js', [
            'page' => ['pingpress', 'club', 'configuration']
        ]);
    }
}
