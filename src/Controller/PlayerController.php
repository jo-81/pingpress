<?php

namespace Pingpress\Controller;

use Pingpress\Service\Filter\PlayerFilterService;
use Pingpress\Service\Metabox\PlayerMetaboxService;
use Pingpress\Service\PostType\PlayerPostTypeService;
use Pingpress\Service\Column\PlayerAdminColumnService;

if (! defined('ABSPATH')) {
    exit;
}

final class PlayerController extends AbstractController
{
    public function __invoke()
    {
        $playerPostType = $this->get(PlayerPostTypeService::class);
        add_action('init', [$playerPostType, 'registerCustomPostType']);

        if (is_admin()) {
            // METABOXES
            $playerMetaboxService = $this->get(PlayerMetaboxService::class);
            add_action('add_meta_boxes', [$playerMetaboxService, 'register'], 10, 2);
            add_action('save_post', [$playerMetaboxService, 'saveMetaBox']);

            // ADMIN COLUMNS
            $playerAdminColumnService = $this->get(PlayerAdminColumnService::class);
            add_action('manage_pp_player_posts_columns', [$playerAdminColumnService, 'managementColumns']);
            add_action('manage_pp_player_posts_custom_column', [$playerAdminColumnService, 'managementValuesColumns'], 10, 2);

            // FILTERS
            $playerFilterService = $this->get(PlayerFilterService::class);
            add_filter('months_dropdown_results', [$playerFilterService, 'deleteFilterDate']);
            add_action('restrict_manage_posts', [$playerFilterService, 'addFilterTaxonomies']);

            add_action('restrict_manage_posts', [$playerFilterService, 'addFilterLicenceType']);
            add_filter('parse_query', [$playerFilterService, 'filterRequestSelectedLicenceType']);
        }
    }
}