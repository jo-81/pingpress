<?php
// Retourne la définition des différents services utilisé par php di

use Pingpress\Module\Module;
use Pingpress\Service\ModuleService;
use Pingpress\Service\OptionService;
use Pingpress\Service\EnqueueService;
use Pingpress\Service\DashboardService;

return [
    'dashboard.service' => DI\create(DashboardService::class)->constructor(DI\get('page.module')),

    // TAXONOMY
    'Pingpress\Service\Taxonomy\*TaxonomyService' => DI\create('Pingpress\Service\Taxonomy\*TaxonomyService')
        ->constructor(DI\get('taxonomy.module'), DI\get('page.module')),

    // POST TYPE
    'Pingpress\Service\PostType\*PostTypeService' => DI\create('Pingpress\Service\PostType\*PostTypeService')
        ->constructor(DI\get('posttype.module')),

    // METABOX
    'Pingpress\Service\Metabox\*MetaboxService' => DI\create('Pingpress\Service\Metabox\*MetaboxService')
        ->constructor(DI\get('metabox.module')),

    // ADMIN COLUMN
    'Pingpress\Service\Column\*ColumnService' => DI\create('Pingpress\Service\Column\*ColumnService')
        ->constructor(DI\get('admin.column.module'))->method('setPostType'),

    // FILTER
    'Pingpress\Service\Filter\*FilterService' => DI\create('Pingpress\Service\Filter\*FilterService')
        ->constructor(DI\get('admin.column.module'))->method('setPostType'),

    'pingpress.module' => DI\create(Module::class),

    'module.service' => DI\create(ModuleService::class)->constructor(DI\get('page.module'), DI\get('pingpress.module')),

    'enqueue.service' => DI\create(EnqueueService::class)->constructor(DI\get('enqueue.module')),

    'option.service' => DI\create(OptionService::class)->constructor(DI\get('option.module')),
];
