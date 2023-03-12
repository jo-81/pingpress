<?php

namespace Pingpress\Service\Filter;

use Pingpress\Enum\LicenceTypeEnum;

if (! defined('ABSPATH')) {
    exit;
}

final class PlayerFilterService extends AbstractFilterService 
{    
    public function setPostType(): self
    {
        $this->postType = 'pp_player';
        
        return $this;
    }
    
    public function getTaxonomies(): array
    {
        return ['pp_player_category', 'pp_season'];
    }

    /**
     * addFilterLicenceType
     * Ajoute d'un filtre pour la licence du joueur
     *
     * @return void
     */
    public function addFilterLicenceType(): void
    {
        
        if (! $this->isPostType()) {
            return;
        }

        $selected = filter_input(INPUT_GET, "pp-licence", FILTER_SANITIZE_SPECIAL_CHARS);
        ?>
            <select id="pp-licence" name="pp-licence">
                <option value="0"><?php esc_html_e('Toutes les licences', 'pingpress'); ?></option>

                <?php foreach(LicenceTypeEnum::cases() as $enum) : ?>
                    <option <?php selected($selected, esc_attr(strtolower($enum->name))); ?> 
                            value="<?php echo esc_attr(strtolower($enum->name)); ?>"><?php esc_html_e($enum->value, 'pingpress'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        
        <?php
    }
    
    /**
     * filterRequestSelectedLicenceType
     * filtre les données en ajoutant la licence du joueur
     *
     * @param  \WP_Query $query
     * @return \WP_Query
     */
    function filterRequestSelectedLicenceType(\WP_Query $query): \WP_Query
    {
        if( !(is_admin() AND $query->is_main_query()) ){ 
            return $query;
        }

        if (
            ! $this->isPostType() ||
            ! isset($_GET['pp-licence']) ||
            empty($_GET['pp-licence'])
        ) {
            return $query;
        }

        $licenceValue = filter_input(INPUT_GET, "pp-licence", FILTER_SANITIZE_SPECIAL_CHARS);
        $query->query_vars['meta_key'] = 'pp_player_licence_type';
        $query->query_vars['meta_value'] = strtoupper($licenceValue);

        return $query;
    }
}