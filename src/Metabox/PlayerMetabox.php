<?php

namespace Pingpress\Metabox;

use Pingpress\Entity\Player;

if (! defined('ABSPATH')) {
    exit;
}

final class PlayerMetabox implements MetaboxInterface
{
    public function getMetaboxes(string ...$datas): array
    {
        $player = new Player();
        $metaboxes = apply_filters('pingpress_module_player_metabox', [
            "detail" => [
                'id'                => 'pp_player_metabox_detail',
                'title'             => __('Détails', 'pingpress'),
                'callback'          => function ($post) use ($player) {
                    $player->set($post);
                    include PINGPRESS_TEMPLATE_DIR . "admin/metabox/player/detail.php";
                },
                'screen'            => 'pp_player',
                'context'           => 'side',
                'show_page_option'  => true,
                'position'          => 0,
            ],
            "metric" => [
                'id'                => 'pp_player_metabox_metric',
                'title'             => __('Métriques', 'pingpress'),
                'callback'          => function ($post) use ($player) {
                    $player->set($post);
                    include PINGPRESS_TEMPLATE_DIR . "admin/metabox/player/metric.php";
                },
                'screen'            => 'pp_player',
                'context'           => 'side',
                'show_page_option'  => true,
                'position'          => 1
            ],
            "event" => [
                'id'                => 'pp_player_metabox_event',
                'title'             => __('Evénements', 'pingpress'),
                'callback'          => function () {
                    include PINGPRESS_TEMPLATE_DIR . "admin/metabox/player/event.php";
                },
                'screen'            => 'pp_player',
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
