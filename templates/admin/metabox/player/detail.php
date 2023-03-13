<?php 

    use Inc\Service\FormService;
    use Pingpress\Enum\LicenceTypeEnum;

    $types = wp_parse_args(LicenceTypeEnum::getLists(), ['0' => __('Tous les types de licence', 'pingpress')]);
?>

<!-- Le type de licence -->
<section class="form-section">
    <?php 
        echo FormService::select([
            'label'     => 'Type de licence',
            'name'      => 'pp_player_licence_type',
            'selected'  => $player->getLicenceType(),
        ], $types);
    ?>
</section>
<!-- Le type de licence -->

<?php if (taxonomy_exists('pp_player_category')) : ?>
    <!-- La catégorie du joueur -->
    <section class="form-section">
        <?php echo FormService::selectTaxonomy([
            'label'             => 'Choisir une catégorie',
            'taxonomy'          => 'pp_player_category',
            'name'              => 'tax_input[pp_player_category][]',
            'show_option_all'   => __('Toutes les catégories', 'pingpress'),
            'selected'          => $player->getTaxonomy('pp_player_category', 'term_id'),
        ]); ?>
    </section>
    <!-- La catégorie du joueur -->
<?php endif; ?>

<?php if (taxonomy_exists('pp_season')) : ?>
    <!-- Les saisosns du joueurs -->
    <section class="form-section">
        <label class="form-label m-0"><?php _e('Sélectionner une ou plusieurs saisons', 'pingpress') ?></label>
            <?php post_categories_meta_box(get_post(), [
                'args' => [
                    'taxonomy'  => 'pp_season',
                ]
            ]); ?>
    </section>
    <!-- Les saisosns du joueurs -->
<?php endif; ?>