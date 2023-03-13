<?php

namespace Pingpress\Service\Column;

use Pingpress\Entity\Team;

if (! defined('ABSPATH')) {
    exit;
}

final class TeamAdminColumnService extends AbstractAdminColumnService
{        
    /**
     * setPostType
     *
     * @return self
     */
    public function setPostType(): self
    {
        $this->postType = 'pp_team';

        return $this;
    }

    public function listRemoveColumns(): array
    {
        return ['date', 'taxonomy-pp_league'];
    }


    /**
     * listColumns
     *
     * @return array
     */
    public function listColumns(): array
    {
        return [
            'pp_team_league'    => 'Ligue',
            'pp_team_is_club'   => 'Appartient au club',
        ];
    }
    
    
    /**
     * listValuesColumns
     *
     * @param  int $id
     * @return array
     */
    public function listValuesColumns(int $id): array
    {
        $team = new Team;
        $team->set($id);

        return [
            'pp_team_league'    => $team->getLeague('name'),
            'pp_team_is_club'   => $team->isClub() == 1 ? __('Oui', 'pingpress') : __('Non', 'pingpress'),
        ];
    }
}
