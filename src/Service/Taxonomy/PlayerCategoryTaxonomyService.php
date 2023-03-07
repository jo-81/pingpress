<?php

namespace Pingpress\Service\Taxonomy;

if (! defined('ABSPATH')) {
    exit;
}

final class PlayerCategoryTaxonomyService extends AbstractTaxonomyService
{
    /**
     * registerTaxonomy
     * Enregistre la taxonomie pp_category
     *
     * @return void
     */
    public function registerTaxonomy(): void
    {
        $labels = [
            'name'              			=> __('Catégories', 'pingpress'),
            'description'                   => __('La catégorie du joueur', 'pingpress'),
            'singular_name'     			=> __('Catégorie', 'pingpress'),
            'search_items'      			=> __('Chercher une catégorie', 'pingpress'),
            'all_items'        				=> __('Toutes les catégories', 'pingpress'),
            'edit_item'         			=> __('Editer la catégorie', 'pingpress'),
            'update_item'       			=> __('Mettre à jour la catégorie', 'pingpress'),
            'add_new_item'     				=> __('Ajouter une nouvelle catégorie', 'pingpress'),
            'new_item_name'     			=> __('Valeur de la nouvelle catégorie', 'pingpress'),
            'separate_items_with_commas'	=> __('Séparer les catégories avec une virgule', 'pingpress'),
            'menu_name'                     => __('Catégories', 'pingpress'),
        ];

        $args = [
            'hierarchical'          => true,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_in_rest'          => true,
            'show_admin_column'     => true,
            'query_var'             => true,
            'show_in_menu'          => false,
            'rewrite'               => ['slug' => __('categories', 'pingpress')],
            'show_in_quick_edit'    => false,
            'meta_box_cb'           => false,
        ];

        $this->taxonomyModule->registerTaxonomy('pp_player_category', ['pp_player'], $args);
    }
    
    /**
     * addListCategoryPlayer
     * Ajoute une liste de taxonomie
     *
     * @return void
     */
    public function addListCategoryPlayer(): void
    {
        $categories = [
            [
                "name"  => __("Poussin", "pingpress"),
                "slug"  => "poussin" 
            ],
            [
                "name"  => __("Benjamin 1", "pingpress"),
                "slug"  => "benjamin-1" 
            ],
            [
                "name"  => __("Benjamin 2", "pingpress"),
                "slug"  => "benjamin-2" 
            ],
            [
                "name"  => __("Minime 1", "pingpress"),
                "slug"  => "minime-1" 
            ],
            [
                "name"  => __("Minime 2", "pingpress"),
                "slug"  => "minime-2" 
            ],
            [
                "name"  => __("Cadet 1", "pingpress"),
                "slug"  => "cadet-1" 
            ],
            [
                "name"  => __("Cadet 2", "pingpress"),
                "slug"  => "cadet-2" 
            ],
            [
                "name"  => __("Cadet 3", "pingpress"),
                "slug"  => "cadet-3" 
            ],
            [
                "name"  => __("Junior 1", "pingpress"),
                "slug"  => "junior-1" 
            ],
            [
                "name"  => __("Junior 2", "pingpress"),
                "slug"  => "junior-2" 
            ],
            [
                "name"  => __("Junior 3", "pingpress"),
                "slug"  => "junior-3" 
            ],
            [
                "name"  => __("Junior 4", "pingpress"),
                "slug"  => "junior-4" 
            ],
            [
                "name"  => __("Vétéran 1", "pingpress"),
                "slug"  => "veteran-1" 
            ],
            [
                "name"  => __("Vétéran 2", "pingpress"),
                "slug"  => "veteran-2" 
            ],
            [
                "name"  => __("Vétéran 3", "pingpress"),
                "slug"  => "veteran-3" 
            ],
            [
                "name"  => __("Vétéran 4", "pingpress"),
                "slug"  => "veteran-4" 
            ],
            [
                "name"  => __("Sénior", "pingpress"),
                "slug"  => "senior"
            ]
        ];

        foreach($categories as $category) {
            $this->taxonomyModule->addTaxonomies($category, 'pp_player_category');
        }
    }
    
    /**
     * taxonomyAddSubpage
     * Ajoute la taxonomie pp_category_player au cpt player
     *
     * @return void
     */
    public function taxonomyAddSubpage(): void
    {
        $this->pageModule->addSubmenuPage(
            [
                'parentSlug'    => 'edit.php?post_type=pp_player',
                'pageTitle'     => __('Catégories', 'pingpress'),
                'menuTitle'     => __('Catégories', 'pingpress'),
                'capability'    => 'manage_options',
                'menuSlug'      => 'edit-tags.php?taxonomy=pp_player_category',
                'callback'      => '',
                'position'      => null
            ]
        );
    }

    /**
     * getParentFileTaxonomy
     * Associe la taxonomie à la page parent
     *
     * @param  string $parentFile
     * @return string
     */
    public function getParentFileTaxonomy(string $parentFile): string
    {
        return $this->pageModule->getParentFileTaxonomy($parentFile, 'edit.php?post_type=pp_player', ['pp_player_category']);
    }
}