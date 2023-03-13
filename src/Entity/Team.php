<?php

namespace Pingpress\Entity;

final class Team extends AbstractEntity
{        
    /**
     * getShortName
     *
     * @return string
     */
    public function getShortName(): string
    {
        return get_post_meta($this->post->ID, 'pp_team_short_name', true);
    }
    
    /**
     * isClub
     *
     * @return bool
     */
    public function isClub(): bool
    {
        return ! empty(get_post_meta($this->post->ID, 'pp_team_is_club', true)) ? true : false;
    }
    
    /**
     * getLeague
     * Retourne la ligue de l'équipe selon la phase et la saison
     *
     * @param  int|null $seasonId
     * @param  int|null $phaseId
     * @return WP_Term|string
     */
    public function getLeague(?string $field = null, ?int $seasonId = null, ?int $phaseId = null): \WP_Term|string
    {
        $season = null == $seasonId ? $this->getCurrentSeason() : $seasonId;
        $phase = null == $phaseId ? $this->getNumberPhase() : $phaseId;

        if (empty($season)) {
            return '';
        }

        $leagues = get_post_meta($this->post->ID, 'pp_team_league', true);
        if (empty($leagues)) {
            return '';
        }

        if (! isset($leagues[$season]) || ! isset($leagues[$season][$phase])) {
            return '';
        }

        $leagueId = $leagues[$season][$phase];
        $league = get_term($leagueId, 'pp_league');

        if ($league instanceof \WP_Term) {

            if (is_null($field)) {
                return $league;
            }

            return $league->$field;
        }

        return '';
    }
}