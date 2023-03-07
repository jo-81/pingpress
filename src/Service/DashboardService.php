<?php

namespace Pingpress\Service;

use Inc\Module\PageModule;

if (! defined('ABSPATH')) {
    exit;
}

final class DashboardService
{
    public function __construct(private PageModule $pageModule)
    {}
    
    /**
     * registerPage
     *
     * @return void
     */
    public function registerPage(): void
    {
        $this->pageModule->addMenuPage([
            'pageMenu'      => 'PingPress',
            'pageTitle'     => 'PingPress',
            'capability'    => 'manage_options',
            'menuSlug'      => 'pingpress',
            'callback'      => function() {
                $this->pageModule->callbackTemplate(PINGPRESS_TEMPLATE_DIR . "admin/dashboard.php");
            },
            'iconUrl'       => 'dashicons-awards',
            'position'      => 26
        ]);
    }
}