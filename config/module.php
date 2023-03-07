<?php
// Retourne la définition des différents modules utilisé par php di

use Inc\Module\PageModule;

return [
    'page.module' => DI\create(PageModule::class),
];