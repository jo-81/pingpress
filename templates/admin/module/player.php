<?php

use Inc\Service\FormService;
use Pingpress\Metabox\PlayerMetabox;

$metaboxes = (new PlayerMetabox)->getMetaboxes('title', 'id', 'position', 'show_page_option');
$metaboxDetails = get_option('pp_player_metabox_detail', []);
$metaboxMetrics = get_option('pp_player_metabox_metric', []);

load_template(PINGPRESS_TEMPLATE_DIR . "/admin/parts/_header-page.php"); ?>

<section class="pp-section-option">
    <?php load_template(PINGPRESS_TEMPLATE_DIR . "/admin/parts/_message.php");  ?>

    <!-- Templates pour affichage des informations d'un joueur -->
    <?php load_template(PINGPRESS_TEMPLATE_DIR . "/admin/module/parts/_template.php", true, [
        'metaboxes' => $metaboxes,
        'module'    => 'player',
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
                        'label'     => __('Catégorie du joueur', 'pingpress'),
                        'name'      => 'pp_player_metabox_detail[player_category]',
                        'checked'   => isset($metaboxDetails['player_category']) ? $metaboxDetails['player_category'] : '',
                    ]);

                    echo FormService::checkbox([
                        'label'     => __('Les saisons', 'pingpress'),
                        'name'      => 'pp_player_metabox_detail[season]',
                        'checked'   => isset($metaboxDetails['season']) ? $metaboxDetails['season'] : '',
                    ]);

                    echo FormService::checkbox([
                        'label'     => __('Licence', 'pingpress'),
                        'name'      => 'pp_player_metabox_detail[licence_type]',
                        'checked'   => isset($metaboxDetails['licence_type']) ? $metaboxDetails['licence_type'] : '',
                    ]);
                ?>
            </div>
        </div>
    </div>
</section>
<!-- Informations sur la metabox detail -->

<!-- Informations sur la metabox métriques -->
<section class="pp-section-option">
    <div class="pp-card">
        <header class="pp-card-header">
            <h2 class="pp-card-title"><?php esc_html_e('Métriques', 'pingpress'); ?></h2>
        </header>

        <div class="grid-option">
            <div class="grid-left">
                <p class="fw-bold"><?php esc_html_e('Sélectionner les informations à afficher', 'pingpress'); ?></p>
            </div>

            <div class="grid-right">
                <?php 
                    echo FormService::checkbox([
                        'label'     => __('Points', 'pingpress'),
                        'name'      => 'pp_player_metabox_metric[points]',
                        'checked'   => isset($metaboxMetrics['points']) ? $metaboxMetrics['points'] : '',
                    ]);

                    echo FormService::checkbox([
                        'label'     => __('Classement', 'pingpress'),
                        'name'      => 'pp_player_metabox_metric[classement]',
                        'checked'   => isset($metaboxMetrics['classement']) ? $metaboxMetrics['classement'] : '',
                    ]);

                    echo FormService::checkbox([
                        'label'     => __('Progression', 'pingpress'),
                        'name'      => 'pp_player_metabox_metric[progression]',
                        'checked'   => isset($metaboxMetrics['progression']) ? $metaboxMetrics['progression'] : '',
                    ]);
                ?>
            </div>
        </div>
    </div>
</section>
<!-- Informations sur la metabox métriques -->

<?php load_template(PINGPRESS_TEMPLATE_DIR . "/admin/parts/_footer-page.php");
