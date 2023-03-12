<?php use Inc\Service\FormService; ?>

<?php if ($currentSeason = $player->getCurrentSeason()) : ?>
<!-- Les points phase 1 -->
<section class="form-section">
    <?php 
        echo FormService::input([
            'label' => 'Points phase 1',
            'type'  => 'number',
            'name'  => 'pp_player_points_phase_1['. esc_attr($currentSeason) .']',
            'value' => $player->getPoints(1),
            'attr'  => [
                'min' => 0,
            ]
        ]);
    ?>
</section>
<!-- Les points phase 1 -->

<?php if ($player->getNumberPhase() == 2) : ?>
    <!-- Les points phase 2 -->
    <section class="form-section">
        <?php 
            echo FormService::input([
                'label' => 'Points phase 2',
                'type'  => 'number',
                'name'  => 'pp_player_points_phase_2['. esc_attr($currentSeason) .']',
                'value' => $player->getPoints(2),
                'attr'  => [
                    'min' => 0,
                ]
            ]);
        ?>
    </section>
    <!-- Les points phase 2 -->
<?php endif; ?>

<!-- Le classement -->
<section class="form-section">
    <?php 
        echo FormService::input([
            'label' => 'Classement',
            'type'  => 'number',
            'value' => $player->getClassement(),
            'attr'  => [
                'disabled' => true,
            ]
        ]);
    ?>
</section>
<!-- Le classement -->

<?php if ($player->getNumberPhase() == 2) : ?>
    <!-- La progression -->
    <section class="form-section">
        <?php 
            echo FormService::input([
                'label' => 'Progression',
                'type'  => 'number',
                'value' => $player->getProgression(),
                'attr'  => [
                    'disabled' => true,
                ]
            ]);
        ?>
    </section>
    <!-- La progression -->
    <?php endif; ?>
<?php else: ?> 
    <p><?php esc_html_e("Vous n'avez pas définit la saison courante", "pingpress"); ?></p>

<?php endif; ?>