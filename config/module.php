<?php
// Retourne la définition des différents modules utilisé par php di

use Inc\Module\PageModule;
use Inc\Module\TaxonomyModule;

return [
    'page.module' => DI\create(PageModule::class),
    'taxonomy.module' => DI\create(TaxonomyModule::class),
];