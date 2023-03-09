<?php

use Inc\Service\FormService;
use Inc\Service\MessageService;

$message = MessageService::get('pingpress_option_message');

load_template(PINGPRESS_TEMPLATE_DIR . "/admin/parts/_header-page.php"); ?>

<section class="pp-section-option">

    <?php
        if ($message) :
            load_template(PINGPRESS_TEMPLATE_DIR . "/admin/parts/_message.php", true, [
                'type'      => $message['type'],
                'message'   => $message['message'],
            ]);
        endif;
    ?>

    <div class="pp-card">
        <header class="pp-card-header">
            <h2 class="pp-card-title"><?php esc_html_e('Informations générales', 'pingpress'); ?></h2>
        </header>

        <!-- Nombre de match par rencontre -->
        <div class="grid-option">
            <div class="grid-left">
                <p class="fw-bold"><?php esc_html_e('Nombre de matchs par rencontre', 'pingpress'); ?></p>
                <small><?php esc_html_e('Pour une rencotre par équipe', 'pingpress'); ?></small>
            </div>

            <div class="grid-right">
                <?php echo FormService::input([
                    'name'  => 'pp_option_number_match_by_event',
                    'value' => get_option('pp_option_number_match_by_event', 14),
                    'type'  => 'number',
                    'attr'  => [
                        'min' => 0,
                    ]
                ]); ?>
            </div>
        </div>
        <!-- Nombre de match par rencontre -->

        <!-- Valeur pour le résultat d'une renconre : V / N / D -->
        <div class="grid-option">
            <div class="grid-left">
                <p class="fw-bold"><?php esc_html_e('Nombre de points d\'un résultat', 'pingpress'); ?></p>
                <small><?php esc_html_e('Pour une rencotre par équipe', 'pingpress'); ?></small>
            </div>

            <div class="grid-right">
                <?php echo FormService::input([
                    'label' => 'Victoire',
                    'type'  => 'number',
                    'name'  => 'pp_option_event_team_result_victory',
                    'value' => get_option('pp_option_event_team_result_victory', 3),
                ]); ?>
                <?php echo FormService::input([
                    'label' => 'Nul',
                    'type'  => 'number',
                    'name'  => 'pp_option_event_team_result_null',
                    'value' => get_option('pp_option_event_team_result_null', 2),
                ]); ?>
                <?php echo FormService::input([
                    'label' => 'Défaite',
                    'type'  => 'number',
                    'name'  => 'pp_option_event_team_result_defeat',
                    'value' => get_option('pp_option_event_team_result_defeat', 1),
                ]); ?>
            </div>
        </div>
        <!-- Valeur pour le résultat d'une renconre : V / N / D -->

    </div>
</section>

<?php load_template(PINGPRESS_TEMPLATE_DIR . "/admin/parts/_footer-page.php");
