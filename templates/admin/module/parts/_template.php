<?php 
    $metaboxes = $args['metaboxes'];
    $module = $args['module'];

    $metaboxesActived = get_option('pp_'. $module .'_metaboxes_actived', []);
    $metaboxesPosition = get_option('pp_'. $module .'_metaboxes_position', []);

    if (! empty($metaboxesPosition)) {
        foreach($metaboxesPosition as $key => $position) {
            $metaboxes[$key]['position'] = $position; 
        }

        $metaboxes = wp_list_sort($metaboxes, 'position', 'ASC', true);
    }
?>

<div class="pp-card">
    <header class="pp-card-header">
        <h2 class="pp-card-title"><?php esc_html_e('Template', 'pingpress'); ?></h2>
    </header>

    <div class="grid-option">
        <div class="grid-left">
            <p class="fw-bold"><?php esc_html_e('Sélectionner les informations à afficher', 'pingpress'); ?></p>
        </div>

        <div id="content-box" class="grid-right grid w-xxl-50">

            <input type="hidden" name="pp_<?php echo esc_attr($module) ?>_metaboxes_actived">
            <input type="hidden" name="pp_<?php echo $module ?>_metaboxes_position">

            <?php foreach($metaboxes as $key => $metabox) : ?>
                <?php if (! $metabox['show_page_option']) : continue; endif; ?>
                <div class="pp-card pp-card-body border rounded flex content-between ui-sortable-handle ui-state-default">

                    <input  type="hidden" 
                            name="pp_<?php echo $module ?>_metaboxes_position[<?php echo esc_attr($key) ?>]" 
                            value="<?php echo esc_attr($metabox['position']); ?>">

                    <p class="uppercase fw-bold small"><?php esc_html_e($metabox['title'], 'pingpress') ?></p>
                    <label class="switch">
                        <input  type="checkbox" 
                                <?php if (isset($metaboxesActived[$key])) : checked($metaboxesActived[$key]); endif; ?>
                                name="pp_<?php echo esc_attr($module) ?>_metaboxes_actived[<?php echo esc_attr($key) ?>]" value="1">
                        <span class="slider"></span>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>

    </div>

</div>