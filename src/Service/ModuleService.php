<?php

namespace Pingpress\Service;

use Inc\Module\PageModule;
use Pingpress\Module\Module;

if (! defined('ABSPATH')) {
    exit;
}

final class ModuleService
{
    public function __construct(private PageModule $pageModule, private Module $module)
    {}
    
    /**
     * registerSubpageAdminMenu
     *
     * @return void
     */
    public function registerSubpageAdminMenu(): void
    {
        $modulesActivates = empty(get_option('pp_module_activated')) ? [] : get_option('pp_module_activated');

        foreach($this->module->getModules() as $label => $module) {

            if (! array_key_exists($label, $modulesActivates) && $module['activable']) {
                continue;
            }

            $this->pageModule->addSubmenuPage(
                [
                    'parentSlug'    => 'pingpress',
                    'pageTitle'     => __(esc_html(ucfirst($module['title'])), 'pingpress'),
                    'menuTitle'     => __(esc_html(ucfirst($module['title'])), 'pingpress'),
                    'capability'    => 'manage_options',
                    'menuSlug'      => $label,
                    'callback'      => function() use ($module) {
                        $this->pageModule->callbackTemplate($module['template']);
                    },
                    'position'      => null
                ]
            );
        }
    }
}