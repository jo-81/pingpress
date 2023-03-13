<?php

namespace Pingpress\Service\Filter;

use Inc\Service\FormService;

use function Pingpress\isPost;

if (! defined('ABSPATH')) {
    exit;
}

final class TeamFilterService extends AbstractFilterService 
{    
    public function setPostType(): self
    {
        $this->postType = 'pp_team';
        
        return $this;
    }
    
    public function getTaxonomies(): array
    {
        return ['pp_season'];
    }
    
    /**
     * addFilterIsClub
     *
     * @return void
     */
    public function addFilterIsClub(): void
    {
        if (! $this->isPostType()) {
            return;
        }

        $selected = filter_input(INPUT_GET, "is_club", FILTER_SANITIZE_SPECIAL_CHARS);
        ?>
            <select id="is_club" name="is_club">
                <option value=""><?php _e("Tous les club", "pingpress"); ?></option>
                <option <?php selected($selected, 'on') ?> value="on"><?php _e("Les équipes du club", "pingpress"); ?></option>
                <option <?php selected($selected, 'no') ?> value="no"><?php _e("Les autres", "pingpress"); ?></option>
            </select>
        
        <?php
    }
    
    /**
     * filterRequestIsClub
     *
     * @param  \WP_Query $query
     * @return WP_Query
     */
    function filterRequestIsClub(\WP_Query $query): \WP_Query
    {
        if( !(is_admin() AND $query->is_main_query()) ){ 
            return $query;
        }

        if (
            ! $this->isPostType() ||
            ! isset($_GET['is_club']) ||
            empty($_GET['is_club'])
        ) {
            return $query;
        }

        $isClub = filter_input(INPUT_GET, "is_club", FILTER_SANITIZE_SPECIAL_CHARS);
        if ($isClub) {
            $query->query_vars['meta_key'] = 'pp_team_is_club';
            $query->query_vars['meta_value'] = 'on';

            if ($isClub == 'no') {
                $query->query_vars['meta_compare'] = '!=';
            }
        }

        return $query;
    }
}