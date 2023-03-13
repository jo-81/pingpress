<?php

namespace Pingpress\Controller;

use Pingpress\Service\Filter\TeamFilterService;
use Pingpress\Service\Metabox\TeamMetaboxService;
use Pingpress\Service\PostType\TeamPostTypeService;
use Pingpress\Service\Column\TeamAdminColumnService;

if (! defined('ABSPATH')) {
    exit;
}

final class TeamController extends AbstractController
{
    public function __invoke()
    {
        $teamPostType = $this->get(TeamPostTypeService::class);
        add_action('init', [$teamPostType, 'registerCustomPostType']);

        if (is_admin()) {
            // METABOXES
            $teamMetaboxService = $this->get(TeamMetaboxService::class);
            add_action('add_meta_boxes', [$teamMetaboxService, 'register'], 10, 2);
            add_action('save_post', [$teamMetaboxService, 'saveMetaBox']);

            // ADMIN COLUMNS
            $teamAdminColumnService = $this->get(TeamAdminColumnService::class);
            add_action('manage_pp_team_posts_columns', [$teamAdminColumnService, 'managementColumns']);
            add_action('manage_pp_team_posts_custom_column', [$teamAdminColumnService, 'managementValuesColumns'], 10, 2);

             // FILTERS
            $teamFilterService = $this->get(TeamFilterService::class);
            add_filter('months_dropdown_results', [$teamFilterService, 'deleteFilterDate']);
            add_action('restrict_manage_posts', [$teamFilterService, 'addFilterTaxonomies']);

            add_action('restrict_manage_posts', [$teamFilterService, 'addFilterIsClub']);
            add_filter('parse_query', [$teamFilterService, 'filterRequestIsClub']);
        }
    }
}
