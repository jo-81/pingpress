<?php

namespace Pingpress\Service\Taxonomy;

if (! defined('ABSPATH')) {
    exit;
}

final class SeasonTaxonomyService extends AbstractTaxonomyService
{
    /**
     * registerTaxonomy
     *
     * @return void
     */
    public function registerTaxonomy(): void
    {
        $labels = [
            'name'              			=> __('Saisons', 'pingpress'),
            'singular_name'     			=> __('Saison', 'pingpress'),
            'search_items'      			=> __('Chercher une saison', 'pingpress'),
            'all_items'        				=> __('Toutes les saisons', 'pingpress'),
            'edit_item'         			=> __('Editer la saison', 'pingpress'),
            'update_item'       			=> __('Mettre à jour la saison', 'pingpress'),
            'add_new_item'     				=> __('Ajouter une nouvelle saison', 'pingpress'),
            'new_item_name'     			=> __('Valeur de la nouvelle saison', 'pingpress'),
            'separate_items_with_commas'	=> __('Séparer les saisons avec une virgule', 'pingpress'),
            'menu_name'                     => __('Saisons', 'pingpress'),
        ];

        $args = [
            'hierarchical'          => true,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_in_rest'          => true,
            'show_admin_column'     => true,
            'rewrite'               => ['slug' => __('saison', 'pingpress')],
            'show_in_menu'          => false,
            'show_in_quick_edit'    => false,
            'meta_box_cb'           => false,
        ];

        $this->taxonomyModule->registerTaxonomy('pp_season', ['pp_player', 'pp_team', 'pp_event'], $args);
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
                'pageTitle'     => __('Saisons', 'pingpress'),
                'menuTitle'     => __('Saisons', 'pingpress'),
                'capability'    => 'manage_options',
                'menuSlug'      => 'edit-tags.php?taxonomy=pp_season',
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
        return $this->pageModule->getParentFileTaxonomy($parentFile, 'pingpress', ['pp_season']);
    }
}
