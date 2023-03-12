<?php

use Inc\Service\ContainerService;
use Psr\Container\ContainerInterface;

load_template(PINGPRESS_TEMPLATE_DIR . "/admin/parts/_header-page.php");

$modules = [];
/** @var ContainerInterface $container */
$container = ContainerService::getContainer();
if ($container->has('pingpress.module')) {
    $modules = $container->get('pingpress.module')?->getModules();
} ?>

<section class="pp-section__left">

    <div class="grid span-2">
        <?php foreach($modules as $key => $module) : ?>
            <article class="pp-card">
                <header class="pp-card-header">
                    <h3 class="pp-card-title"><?php esc_html_e($module['title'], 'pingpress'); ?></h3>
                </header>
                <div class="pp-card-body">
                    <?php esc_html_e($module['description'], 'pingpress'); ?>
                </div>
                <footer class="pp-card-footer">
                    <a class="btn btn-link" href="<?php echo esc_url(add_query_arg('page', $key, admin_url('admin.php'))); ?>">configurer</a>
                </footer>
            </article>
        <?php endforeach; ?>
    </div>

    <?php load_template(PINGPRESS_TEMPLATE_DIR . "/admin/parts/_aside-page.php"); ?>

</section>

<?php load_template(PINGPRESS_TEMPLATE_DIR . "/admin/parts/_footer-page.php", true, [
    'show_button' => false,
]); ?>