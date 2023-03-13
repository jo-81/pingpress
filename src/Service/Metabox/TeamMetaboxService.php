<?php

namespace Pingpress\Service\Metabox;

use Pingpress\Metabox\TeamMetabox;
use Pingpress\Metabox\MetaboxInterface;

if (! defined('ABSPATH')) {
    exit;
}

final class TeamMetaboxService extends AbstractMetaboxService
{    
    /**
     * getMetaboxInterface
     *
     * @return MetaboxInterface
     */
    public function getMetaboxInterface(): MetaboxInterface
    {
        return new TeamMetabox;
    }
    
    /**
     * getPostType
     *
     * @return string
     */
    public function getPostType(): string
    {
        return 'pp_team';
    }

    public function saveMetaBox(string $post_id): void
    {
        if (
            (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) ||
            (defined('DOING_AJAX') && DOING_AJAX)
        ) {
            return;
        }

        if (isset($_POST['pp_team_league'])) {
            $_POST['pp_team_league'] = $this->mergeLeagues($_POST['pp_team_league'], $post_id);
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

    private function mergeLeagues(array $datas, string $post_id): array
    {
        $oldLeagues = get_post_meta($post_id, 'pp_team_league', true);
        if (empty($oldLeagues)) {
            return $datas;
        }

        return array_replace($oldLeagues, $datas);
    }
}
