<?php

namespace Pingpress\Entity;

abstract class AbstractEntity
{
    protected \WP_Post $post;
    
    /**
     * set
     *
     * @param  int|\WP_Post $post
     * @return self
     */
    public function set(int|\WP_Post $post): self
    {
        if ($post instanceof \WP_Post) {
            $this->post = $post;
        } else {
            $this->post = get_post($post);
        }

        return $this;
    }
    
    /**
     * getCurrentSeason
     *
     * @return string
     */
    public function getCurrentSeason(): string
    {
        $currentSaison = get_option('pp_option_current_season');
        if (! $currentSaison) {
            return '';
        }

        return $currentSaison;
    }

    /**
     * getTaxonomies
     *
     * @param  string $tax
     * @return array
     */
    public function getTaxonomies(string $taxonomy, string $order = 'ASC'): array
    {
        if (! taxonomy_exists($taxonomy) || is_null($this->post)) {
            return [];
        }
        $terms = get_the_terms($this->post, $taxonomy);
        return (!$terms || $terms instanceof \WP_Error) ? [] : wp_list_sort($terms, 'slug', $order);
    }
    
    /**
     * getTaxonomy
     *
     * @param  string $taxonomy
     * @return WP_Term|string|null
     */
    public function getTaxonomy(string $taxonomy, ?string $field = null, string $order = 'ASC')
    {
        $taxonomies = $this->getTaxonomies($taxonomy, $order);
        if (is_null($field)) {
            return isset($taxonomies[0]) ? $taxonomies[0] : null;
        }

        return isset($taxonomies[0]) ? $taxonomies[0]->$field : null;
    }
    
    /**
     * getNumberPhase
     *
     * @param  string $date
     * @return int
     */
    public function getNumberPhase(string $date = 'now'): int
    {
        $dateTime = new \DateTimeImmutable($date);
        $month = (int) $dateTime->format("m");
        if ($month >= 9 && $month <= 12) {
            return 1;
        }

        return 2;
    }
}