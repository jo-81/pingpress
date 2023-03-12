<?php

namespace Pingpress\Entity;

final class Player extends AbstractEntity
{    
    /**
     * getLicenceType
     *
     * @return string
     */
    public function getLicenceType(): string
    {
        return get_post_meta($this->post->ID, 'pp_player_licence_type', true);
    }

    /**
     * getPoints
     *
     * @param  int $phase
     * @param  \WP_Term|null $season
     * @return int
     */
    public function getPoints(int $phase, ?\WP_Term $season = null): int
    {
        $currentSaison = is_null($season) ? $this->getCurrentSeason() : $season->term_id;
        if (empty($currentSaison)) {
            return 0;
        }

        $dataPoints = get_post_meta($this->post->ID, 'pp_player_points_phase_' . $phase, true);
        if (! isset($dataPoints[$currentSaison])) {
            return 500; 
        }

        return (int) $dataPoints[$currentSaison];
    }
    
    /**
     * getClassement
     *
     * @param  null|int $phase
     * @param  null|\WP_Post $season
     * @return int
     */
    public function getClassement(?int $phase = null, ?\WP_Term $season = null): int
    {
        $numberPhase = is_null($phase) ?  $this->getNumberPhase() : $phase;
        return $this->getPoints($numberPhase, $season) / 100;
    }
    
    /**
     * getProgression
     *
     * @param  \WP_Term|null $season
     * @return int
     */
    public function getProgression(?\WP_Term $season = null): int
    {
        if ($this->getNumberPhase() != 2 || $this->getPoints(2, $season) == 0) {
            return 0;
        }

        return $this->getPoints(2, $season) - $this->getPoints(1, $season);
    }
}