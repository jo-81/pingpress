<?php

namespace Pingpress\Service\Taxonomy;

if (! defined('ABSPATH')) {
    exit;
}

final class LeagueTaxonomyService extends AbstractTaxonomyService
{
    /**
     * registerTaxonomy
     *
     * @return void
     */
    public function registerTaxonomy(): void
    {
        $labels = [
            'name'              			=> __('Ligues', 'pingpress'),
            'singular_name'     			=> __('Ligue', 'pingpress'),
            'search_items'      			=> __('Chercher une ligue', 'pingpress'),
            'all_items'        				=> __('Toutes les ligues', 'pingpress'),
            'edit_item'         			=> __('Editer la ligue', 'pingpress'),
            'update_item'       			=> __('Mettre à jour la ligue', 'pingpress'),
            'add_new_item'     				=> __('Ajouter une nouvelle ligue', 'pingpress'),
            'new_item_name'     			=> __('Valeur de la nouvelle ligue', 'pingpress'),
            'separate_items_with_commas'	=> __('Séparer les ligues avec une virgule', 'pingpress'),
            'menu_name'                     => __('ligues', 'pingpress'),
        ];

        $args = [
            'hierarchical'          => true,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_in_rest'          => true,
            'show_admin_column'     => true,
            'rewrite'               => ['slug' => __('ligue', 'pingpress')],
            'show_in_menu'          => false,
            'show_in_quick_edit'    => false,
            'meta_box_cb'           => false,
        ];

        $this->taxonomyModule->registerTaxonomy('pp_league', ['pp_team', 'pp_event'], $args);
    }

    /**
     * taxonomyAddSubpage
     * Ajoute la taxonomie en tant que sous page
     *
     * @return void
     */
    public function taxonomyAddSubpage(): void
    {
        $this->pageModule->addSubmenuPage(
            [
                'parentSlug'    => 'pingpress',
                'pageTitle'     => __('Ligues', 'pingpress'),
                'menuTitle'     => __('Ligues', 'pingpress'),
                'capability'    => 'manage_options',
                'menuSlug'      => 'edit-tags.php?taxonomy=pp_league',
                'callback'      => '',
                'position'      => null,
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
        return $this->pageModule->getParentFileTaxonomy($parentFile, 'pingpress', ['pp_league']);
    }
}
