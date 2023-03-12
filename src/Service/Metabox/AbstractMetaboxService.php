<?php

namespace Pingpress\Service\Metabox;

use Inc\Module\MetaboxModule;
use Pingpress\Metabox\MetaboxInterface;

if (! defined('ABSPATH')) {
    exit;
}

abstract class AbstractMetaboxService
{
    public function __construct(protected MetaboxModule $metaboxModule)
    {}
    
    /**
     * getPostType
     * Retourne le type de custom post type
     *
     * @return string
     */
    abstract public function getPostType(): string;
    
    /**
     * getMetaboxInterface
     * Retourne la classe qui contenant les différentes metaboxes
     *
     * @return MetaboxInterface
     */
    abstract public function getMetaboxInterface(): MetaboxInterface;

    /**
     * addMetaBoxes
     * Ajoute les différentes metabox
     *
     * @return void
     */
    public function addMetaBoxes(string $post_type, \WP_Post $post): void
    {
        if ($post_type != $this->getPostType()) {
            $this->metaboxModule = [];
            return;
        }

        foreach ($this->getMetaboxInterface()->getMetaboxes()as $metabox) {
            if (isset($metabox['conditional']) && !$metabox['conditional']($post)) {
                continue;
            }
            $this->metaboxModule->addMetaBox($metabox);
        }
    }

    /**
     * register
     * Ajoute les différentes metabox aux custom post type
     *
     * @return void
     */
    public function register(string $post_type, \WP_Post $post): void
    {
        $this->addMetaBoxes($post_type, $post);
        $this->metaboxModule->registerMetaBoxes();
    }

    /**
     * saveMetaBox
     * Sauvegarde les différentes valeurs des metaboxes
     *
     * @param  mixed $post_id
     * @return void
     */
    public function saveMetaBox(string $post_id): void
    {
        if (
            (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) ||
            (defined('DOING_AJAX') && DOING_AJAX)
        ) {
            return;
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
}
