<?php

namespace Pingpress\Service\Metabox;

use Pingpress\Metabox\MetaboxInterface;
use Pingpress\Metabox\PlayerMetabox;

if (! defined('ABSPATH')) {
    exit;
}

final class PlayerMetaboxService extends AbstractMetaboxService
{    
    /**
     * getMetaboxInterface
     *
     * @return MetaboxInterface
     */
    public function getMetaboxInterface(): MetaboxInterface
    {
        return new PlayerMetabox;
    }
    
    /**
     * getPostType
     *
     * @return string
     */
    public function getPostType(): string
    {
        return 'pp_player';
    }

    public function saveMetaBox(string $post_id): void
    {
        if (
            (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) ||
            (defined('DOING_AJAX') && DOING_AJAX)
        ) {
            return;
        }

        if (isset($_POST['pp_player_points_phase_1'])) {
            $_POST['pp_player_points_phase_1'] = $this->mergePoints($_POST['pp_player_points_phase_1'], $post_id, 1);
        }

        if (isset($_POST['pp_player_points_phase_2'])) {
            $_POST['pp_player_points_phase_2'] = $this->mergePoints($_POST['pp_player_points_phase_2'], $post_id, 2);
        }

        $post = get_post($post_id);
        if (! $this->metaboxModule->verifyNonceMetaBox($post, $this->getPostType())) {
            return;
        }

        foreach ($_POST as $param => $value) {
            if (preg_match("#". str_replace('pp_', '', $this->getPostType()) ."#", $param)) {
                $this->metaboxModule->saveDatasMetaBox($post_id, $param, map_deep($value, 'sanitize_text_field'));
            }
        }
    }
    
    /**
     * mergePoints
     *
     * @param  array $datas
     * @param  string $post_id
     * @param  int $phase
     * @return array
     */
    private function mergePoints(array $datas, string $post_id, int $phase): array
    {
        $oldPoints = get_post_meta($post_id, 'pp_player_points_phase_' . $phase, true);
        if (empty($oldPoints)) {
            return $datas;
        }

        return array_replace($oldPoints, $datas);
    }
}
