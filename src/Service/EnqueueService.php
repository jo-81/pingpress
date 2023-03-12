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

    public function registerScript()
    {
        $this->enqueueModule->registerPluginJQuery("jquery-ui-sortable", [
            'page' => ['pingpress', 'club', 'configuration', 'player']
        ]);
    }

    /**
     * registerAssets
     *
     * @return void
     */
    public function registerAssets(): void
    {
        $this->enqueueModule->registerCdn('pingpress_admin_style_icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css', [
            'page' => ['pingpress', 'club', 'configuration', 'player']
        ]);

        $this->enqueueModule->registerStyle('pingpress_admin_style', '/pingpress/src/public/admin/css/admin.css', [
            'page' => ['pingpress', 'club', 'configuration', 'player']
        ]);

        $this->enqueueModule->registerStyle('pingpress_admin_post_type_style', '/pingpress/src/public/admin/css/post-type.css', [
            'post_type' => ['pp_player']
        ]);

        $this->enqueueModule->registerScript('pingpress_admin_script', '/pingpress/src/public/admin/js/admin.js', [
            'page' => ['pingpress', 'club', 'configuration', 'player']
        ]);
    }
}
