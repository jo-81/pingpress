<?php 

$defaults = [
    'message'   => '',
    'type'      => 'success',
];

$args = wp_parse_args($args, $defaults);

$icons = [
    'success'   => '<i class="bi bi-check-lg"></i>',
    'info'      => '<i class="bi bi-info-circle"></i>',
    'danger'    => '<i class="bi bi-exclamation-triangle-fill"></i>',
    'warning'   => '<i class="bi bi-exclamation-lg"></i>',
];

?>

<div class="pp-alert <?php echo esc_attr($args['type'], 'pingpress'); ?>">
    <p>
        <span class="icon"><?php echo $icons[$args['type']]; ?></span>
        <span><?php esc_html_e($args['message'], 'pingpress'); ?></span>
    </p>
    <p><span class="dashicons dashicons-no-alt close"></span></p>
</div>