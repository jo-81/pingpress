<?php

namespace Pingpress\Metabox;

use Pingpress\Entity\Team;

if (! defined('ABSPATH')) {
    exit;
}

final class TeamMetabox implements MetaboxInterface
{
    public function getMetaboxes(string ...$datas): array
    {
        $team = new Team();
        $metaboxes = apply_filters('pingpress_module_team_metabox', [
            "detail" => [
                'id'                => 'pp_team_metabox_detail',
                'title'             => __('Détails', 'pingpress'),
                'callback'          => function ($post) use ($team) {
                    $team->set($post);
                    include PINGPRESS_TEMPLATE_DIR . "admin/metabox/team/detail.php";
                },
                'screen'            => 'pp_team',
                'context'           => 'side',
                'show_page_option'  => true,
                'position'          => 0,
            ],
            "event" => [
                'id'                => 'pp_team_metabox_event',
                'title'             => __('Evénements', 'pingpress'),
                'callback'          => function ($post) use ($team) {
                    include PINGPRESS_TEMPLATE_DIR . "admin/metabox/team/event.php";
                },
                'screen'            => 'pp_team',
                'context'           => 'normal',
                'show_page_option'  => true,
                'position'          => 2
            ],
        ]);

        if (! empty($datas)) {
            $m = [];
            foreach($metaboxes as $key => $metabox) {
                foreach($datas as $data) {
                    $m[$key][$data] = $metabox[$data];
                }
            }
            return $m;
        }

        return $metaboxes;
    }
}
