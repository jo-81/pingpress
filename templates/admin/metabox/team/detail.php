<?php use Inc\Service\FormService; ?>

<!-- Si l'équipe appartient au club -->
<section class="form-section">
    <?php echo FormService::checkbox([
        'label'     => __('Appartient au club', 'pingpress'),
        'name'      => 'pp_team_is_club',
        'checked'   => $team->isClub(),
    ]); ?>
</section>
<!-- Si l'équipe appartient au club -->

<!-- Le nom court -->
<section class="form-section">
    <?php 
        echo FormService::input([
            'label' => 'Abbréviation',
            'name'  => 'pp_team_short_name',
            'value' => $team->getShortName(),
        ]);
    ?>
</section>
<!-- Le nom court -->

<?php if (taxonomy_exists('pp_season')) : ?>
    <!-- Les saisons -->
    <section class="form-section">
        <label class="form-label m-0"><?php _e('Sélectionner une ou plusieurs saisons', 'pingpress') ?></label>
            <?php post_categories_meta_box(get_post(), [
                'args' => [
                    'taxonomy'  => 'pp_season',
                ]
            ]); ?>
    </section>
    <!-- Les saisons -->
<?php endif; ?>

<?php
    if (taxonomy_exists('pp_league')) :
        if ($currentSeason = $team->getCurrentSeason()) : ?>
        <!-- Les liguew -->
        <section class="form-section">
            <?php 
                echo FormService::selectTaxonomy([
                    'taxonomy'          => 'pp_league',
                    'label'             => __('Sélectionner une ligue', 'pingpress'), 
                    'name'              => "pp_team_league[$currentSeason][".$team->getNumberPhase()."]",
                    'show_option_all'   => __('Toutes les ligues', 'pingpress'),
                    'selected'          => $team->getLeague('term_id'),
                ]);
            ?>
        </section>
        <!-- Les saisons -->
        <?php endif; 
    endif; 