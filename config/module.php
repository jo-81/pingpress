<?php
// Retourne la définition des différents modules utilisé par php di

use Inc\Module\PageModule;
use Inc\Module\OptionModule;
use Inc\Module\EnqueueModule;
use Inc\Module\MetaboxModule;
use Inc\Module\PostTypeModule;
use Inc\Module\TaxonomyModule;
use Inc\Module\ColumnAdminModule;

return [
    'page.module'           => DI\create(PageModule::class),
    'taxonomy.module'       => DI\create(TaxonomyModule::class),
    'enqueue.module'        => DI\create(EnqueueModule::class),
    'option.module'         => DI\create(OptionModule::class),
    'posttype.module'       => DI\create(PostTypeModule::class),
    'metabox.module'        => DI\create(MetaboxModule::class),
    'admin.column.module'   => DI\create(ColumnAdminModule::class),
];