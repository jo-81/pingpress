<?php

namespace Pingpress\Service\Column;

use Pingpress\Entity\Player;

if (! defined('ABSPATH')) {
    exit;
}

final class PlayerAdminColumnService extends AbstractAdminColumnService
{        
    /**
     * setPostType
     *
     * @return self
     */
    public function setPostType(): self
    {
        $this->postType = 'pp_player';

        return $this;
    }


    /**
     * listColumns
     *
     * @return array
     */
    public function listColumns(): array
    {
        return [
            'pp_player_classement'      => 'Classement',
            'pp_player_licence_type'    => 'Licence',
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
        $player = new Player;
        $player->set($id);

        return [
            'pp_player_classement'      => $player->getClassement(),
            'pp_player_licence_type'    => __(ucfirst($player->getLicenceType()), 'pingpress'),
        ];
    }
}
