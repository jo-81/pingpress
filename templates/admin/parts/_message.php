<?php 

use Inc\Service\MessageService;

$message = MessageService::get('pingpress_option_message');

$icons = [
    'success'   => '<i class="bi bi-check-lg"></i>',
    'info'      => '<i class="bi bi-info-circle"></i>',
    'danger'    => '<i class="bi bi-exclamation-triangle-fill"></i>',
    'warning'   => '<i class="bi bi-exclamation-lg"></i>',
];

if ($message) :
?>

    <div class="pp-alert <?php echo esc_attr($message['type'], 'pingpress'); ?>">
        <p>
            <span class="icon"><?php echo $icons[$message['type']]; ?></span>
            <span><?php esc_html_e($message['message'], 'pingpress'); ?></span>
        </p>
        <p><span class="dashicons dashicons-no-alt close"></span></p>
    </div>

<?php endif; 