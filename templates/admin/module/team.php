<?php

use Inc\Service\FormService;
use Pingpress\Metabox\TeamMetabox;

$metaboxes = (new TeamMetabox)->getMetaboxes('title', 'id', 'position', 'show_page_option');
$metaboxDetails = get_option('pp_team_metabox_detail', []);
$metaboxMetrics = get_option('pp_team_metabox_metric', []);

load_template(PINGPRESS_TEMPLATE_DIR . "/admin/parts/_header-page.php"); ?>

<section class="pp-section-option">
    <?php load_template(PINGPRESS_TEMPLATE_DIR . "/admin/parts/_message.php");  ?>

    <!-- Templates pour affichage des informations d'un joueur -->
    <?php load_template(PINGPRESS_TEMPLATE_DIR . "/admin/module/parts/_template.php", true, [
        'metaboxes' => $metaboxes,
        'module'    => 'team',
    ]); ?>
    <!-- Templates pour affichage des informations d'un joueur -->
</section>

<!-- Informations sur la metabox detail -->
<section class="pp-section-option">
    <div class="pp-card">
        <header class="pp-card-header">
            <h2 class="pp-card-title"><?php esc_html_e('Détails', 'pingpress'); ?></h2>
        </header>

        <div class="grid-option">
            <div class="grid-left">
                <p class="fw-bold"><?php esc_html_e('Sélectionner les informations à afficher', 'pingpress'); ?></p>
            </div>

            <div class="grid-right">
                <?php 
                    echo FormService::checkbox([
                        'label'     => __('Equipe appartenant au club', 'pingpress'),
                        'name'      => 'pp_team_metabox_detail[is_club]',
                        'checked'   => isset($metaboxDetails['is_club']) ? $metaboxDetails['is_club'] : '',
                    ]);

                    echo FormService::checkbox([
                        'label'     => __('Les saisons', 'pingpress'),
                        'name'      => 'pp_team_metabox_detail[season]',
                        'checked'   => isset($metaboxDetails['season']) ? $metaboxDetails['season'] : '',
                    ]);

                    echo FormService::checkbox([
                        'label'     => __('La ligue', 'pingpress'),
                        'name'      => 'pp_team_metabox_detail[league]',
                        'checked'   => isset($metaboxDetails['league']) ? $metaboxDetails['league'] : '',
                    ]);
                ?>
            </div>
        </div>
    </div>
</section>
<!-- Informations sur la metabox detail -->

<?php load_template(PINGPRESS_TEMPLATE_DIR . "/admin/parts/_footer-page.php");
