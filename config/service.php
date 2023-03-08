<?php
// Retourne la définition des différents services utilisé par php di

use Pingpress\Module\Module;
use Pingpress\Service\DashboardService;
use Pingpress\Service\ModuleService;

return [
    'dashboard.service' => DI\create(DashboardService::class)->constructor(DI\get('page.module')),
    'Pingpress\Service\Taxonomy\*TaxonomyService' => DI\create('Pingpress\Service\Taxonomy\*TaxonomyService')
        ->constructor(DI\get('taxonomy.module'), DI\get('page.module')),

    'pingpress.module' => DI\create(Module::class),

    'module.service' => DI\create(ModuleService::class)->constructor(DI\get('page.module'), DI\get('pingpress.module')),
];
