<?php

namespace Pingpress\Module;

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Module
 * Liste des diiférents modules pour le plugin PingPress
 * 
 *      - title     -> le tittre du module
 *      - activale  -> si l'utilisateur peut activer / désactiver le module
 *      - show_menu -> Si le module doit être affiché sous la page Pingpress
 */
final class Module
{
    public function getModules(): array
    {
        return apply_filters('pingpress_modules', [
            'club' => [
                'title'         => __('Mon club', 'pingpress'),
                'activable'     => false,
                'template'      => PINGPRESS_TEMPLATE_DIR . "/admin/module/club.php",
                'show_menu'     => true,
                'description'   => 'Renseigner les différentes informations demandées concernant votre club',
            ],
            'configuration' => [
                'title'         => __('Configuration', 'pingpress'),
                'activable'     => false,
                'template'      => PINGPRESS_TEMPLATE_DIR . "/admin/module/configuration.php",
                'show_menu'     => true,
                'description'   => 'Configuration général du plugin',
            ],
            'player' => [
                'title'         => __('Joueurs', 'pingpress'),
                'activable'     => false,
                'template'      => PINGPRESS_TEMPLATE_DIR . "/admin/module/player.php",
                'show_menu'     => true,
                'description'   => 'Informations général et configuration concernant vos joueurs',
            ],
            'team' => [
                'title'         => __('Equipes', 'pingpress'),
                'activable'     => false,
                'template'      => PINGPRESS_TEMPLATE_DIR . "/admin/module/team.php",
                'show_menu'     => true,
                'description'   => 'Informations général et configuration concernant vos équipes',
            ],
        ]);
    }
}
