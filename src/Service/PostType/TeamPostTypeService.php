<?php

namespace Pingpress\Service\PostType;

if (! defined('ABSPATH')) {
    exit;
}

final class TeamPostTypeService extends AbstractPostTypeService
{
    /**
     * registerCustomPostType
     *
     * @return void
     */
    public function registerCustomPostType(): void
    {
        $labels = [
            'name'                => __('Equipes', 'pingpress'),
            'singular_name'       => __('Equipe', 'pingpress'),
            'menu_name'           => __('Equipes', 'pingpress'),
            'all_items'           => __('Toutes les équipes', 'pingpress'),
            'view_item'           => __('Voir les équipes', 'pingpress'),
            'add_new_item'        => __('Ajouter une nouvelle équipe', 'pingpress'),
            'add_new'             => __('Ajouter', 'pingpress'),
            'edit_item'           => __('Editer l\'équipe', 'pingpress'),
            'update_item'         => __('Modifier l\'équipe', 'pingpress'),
            'search_items'        => __('Rechercher une équipe', 'pingpress'),
            'not_found'           => __('Non trouvée', 'pingpress'),
            'not_found_in_trash'  => __('Non trouvée dans la corbeille', 'pingpress'),
        ];

        $args = [
            'label'                 => __('Equipes', 'pingpress'),
            'description'           => __('Tous sur équipes', 'pingpress'),
            'labels'                => $labels,
            'supports'              => ['title'],
            'show_in_rest'          => false,
            'hierarchical'          => true,
            'public'                => true,
            'has_archive'           => true,
            'rewrite'			    => ['slug' => __('equipes', 'pingpress')],
            'menu_position'         => 28,
            'query_var'             => true,
            'taxonomies'            => ['pp_season', 'pp_league'],
            'menu_icon'             => 'dashicons-shield'
        ];

        $this->customPostTypeModule->registerCustomPostType('pp_team', $args);
    }
}
