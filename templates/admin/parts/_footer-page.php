<?php 
    $defauls = [
        'show_button' => true,
    ];

    $args = wp_parse_args($args, $defauls);
?>
            <?php wp_nonce_field(OPTION_MODULE_NONCE . "_action",  OPTION_MODULE_NONCE . "_field"); ?>
            
            <?php if ($args['show_button']) : ?>
            <div class="pp-section-form-button">
                <button class="btn btn-link" type="submit"><?php _e('enregistrer', 'pingpress'); ?></button>
            </div>
            <?php endif; ?>
        </section>
    </section>
</form>