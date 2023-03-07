<?php

namespace Pingpress\Controller;

use Pingpress\Service\Taxonomy\LeagueTaxonomyService;
use Pingpress\Service\Taxonomy\SeasonTaxonomyService;
use Pingpress\Service\Taxonomy\PlayerCategoryTaxonomyService;

if (! defined('ABSPATH')) {
    exit;
}

final class TaxonomyController extends AbstractController
{
    public function __invoke()
    {
        $seasonTaxonomy = $this->get(SeasonTaxonomyService::class);
        $playerCategoryTaxonomy = $this->get(PlayerCategoryTaxonomyService::class);
        $leagueTaxonomy = $this->get(LeagueTaxonomyService::class);

        add_action('init', [$seasonTaxonomy, 'registerTaxonomy']);
        add_action('init', [$playerCategoryTaxonomy, 'registerTaxonomy']);
        add_action('init', [$leagueTaxonomy, 'registerTaxonomy']);

        if (is_admin()) {
            // SEASON
            add_action('admin_menu', [$seasonTaxonomy, 'taxonomyAddSubpage']);
            add_filter('parent_file', [$seasonTaxonomy, 'getParentFileTaxonomy']);

             // LEAGUE
            add_action('admin_menu', [$leagueTaxonomy, 'taxonomyAddSubpage']);
            add_filter('parent_file', [$leagueTaxonomy, 'getParentFileTaxonomy']);

            // PLAYER CATEGORY
            add_action('admin_menu', [$playerCategoryTaxonomy, 'taxonomyAddSubpage']);
            add_filter('parent_file', [$playerCategoryTaxonomy, 'getParentFileTaxonomy']);
            add_action('init', [$playerCategoryTaxonomy, 'addListCategoryPlayer']);
        }
    }
}