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

    <!-- Informations générales du le club -->
    <div class="pp-card">
        <header class="pp-card-header">
            <h2 class="pp-card-title"><?php esc_html_e('Informations générales', 'pingpress'); ?></h2>
        </header>

        <div class="grid-option">
            <div class="grid-left">
                <p class="fw-bold"><?php esc_html_e('Nom du club', 'pingpress'); ?></p>
            </div>

            <div class="grid-right">
                <?php echo FormService::input([
                    'name' => 'pp_option_club_name',
                    'value' => get_option('pp_option_club_name', ''),
                ]); ?>
            </div>
        </div>

        <div class="grid-option">
            <div class="grid-left">
                <p class="fw-bold"><?php esc_html_e('Adresse email', 'pingpress'); ?></p>
            </div>

            <div class="grid-right">
                <?php echo FormService::input([
                    'type' => 'email',
                    'name' => 'pp_option_club_email',
                    'value' => get_option('pp_option_club_email', ''),
                ]); ?>
            </div>
        </div>

    </div>
    <!-- Informations générales du le club -->
</section>

<?php load_template(PINGPRESS_TEMPLATE_DIR . "/admin/parts/_footer-page.php");
