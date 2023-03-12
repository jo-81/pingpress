<?php

namespace Pingpress\Service\PostType;

if (! defined('ABSPATH')) {
    exit;
}

final class PlayerPostTypeService extends AbstractPostTypeService
{
    /**
     * registerCustomPostType
     *
     * @return void
     */
    public function registerCustomPostType(): void
    {
        $labels = [
            'name'                => __('Joueurs', 'pingpress'),
            'singular_name'       => __('Joueur', 'pingpress'),
            'menu_name'           => __('Joueurs', 'pingpress'),
            'all_items'           => __('Tous les joueurs', 'pingpress'),
            'view_item'           => __('Voir les joueurs', 'pingpress'),
            'add_new_item'        => __('Ajouter un nouveau joueur', 'pingpress'),
            'add_new'             => __('Ajouter', 'pingpress'),
            'edit_item'           => __('Editer le joueur', 'pingpress'),
            'update_item'         => __('Modifier le joueur', 'pingpress'),
            'search_items'        => __('Rechercher un joueur', 'pingpress'),
            'not_found'           => __('Non trouvée', 'pingpress'),
            'not_found_in_trash'  => __('Non trouvée dans la corbeille', 'pingpress'),
        ];

        $args = [
            'label'                 => __('Joueurs', 'pingpress'),
            'description'           => __('Tous sur joueurs', 'pingpress'),
            'labels'                => $labels,
            'supports'              => ['title'],
            'show_in_rest'          => false,
            'show_in_admin_bar'     => true,
            'hierarchical'          => true,
            'public'                => true,
            'has_archive'           => true,
            'rewrite'			    => ['slug' => __('joueurs', 'pingpress')],
            'menu_position'         => 27,
            'taxonomies'            => ['pp_season', 'pp_player_category'],
            'menu_icon'             => 'dashicons-universal-access'
        ];

        $this->customPostTypeModule->registerCustomPostType('pp_player', $args);
    }
}
