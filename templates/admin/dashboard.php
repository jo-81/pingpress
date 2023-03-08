<?php

use Inc\Service\ContainerService;
use Psr\Container\ContainerInterface;

load_template(PINGPRESS_TEMPLATE_DIR . "/admin/parts/_header-page.php", false); 

$modules = [];

/** @var ContainerInterface $container */
$container = ContainerService::getContainer();
if ($container->has('pingpress.module')) {
    $modules = $container->get('pingpress.module')?->getModules();
}

foreach($modules as $key => $module) : ?>
    <article class="pp-card">
        <header class="pp-card-header">
            <h4><?php _e($module['title'], 'pingpress') ?></h4>
        </header>
        <div class="pp-card-body">

        </div>
    </article>
<?php endforeach;


load_template(PINGPRESS_TEMPLATE_DIR . "/admin/parts/_footer-page.php"); ?>