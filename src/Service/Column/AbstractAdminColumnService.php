<?php

namespace Pingpress\Service\Column;

use Inc\Module\ColumnAdminModule;

if (! defined('ABSPATH')) {
    exit;
}

abstract class AbstractAdminColumnService
{
    protected ?string $postType = null;

    public function __construct(protected ColumnAdminModule $columnAdminModule)
    {}
    
    /**
     * setPostType
     * Retourne le type du custom post type
     *
     * @return self
     */
    abstract public function setPostType(): self;

        
    /**
     * listColumns
     * Liste les différents colonnes
     *
     * @return array
     */
    abstract public function listColumns(): array;

    public function listRemoveColumns(): array
    {
        return ['date'];
    }

        
    /**
     * listValuesColumns
     * Liste la valeur des colonnes ajoutées
     * 
     * @param  int $id
     * @return array
     */
    abstract public function listValuesColumns(int $id): array;
    
    /**
     * managementColumns
     *
     * @param  array $columns
     * @return array
     */
    public function managementColumns(array $columns): array
    {
        $excludes = [];
        if (! empty($column = $this->listRemoveColumns())) {
            $excludes = array_map( fn($data) => $columns[$data], $column);
        }

        $deleteDate = $this->columnAdminModule->removeColumns($columns, $excludes);
        $newColumns = apply_filters("pingpress_{$this->postType}_admin_column", wp_parse_args($this->listColumns(), $deleteDate));
        return $this->columnAdminModule->addColumns($newColumns);
    }
    
    /**
     * managementValuesColumns
     *
     * @param  string $column
     * @param  string $post_id
     * @return void
     */
    public function managementValuesColumns(string $column, string $post_id): void
    {
        $values = apply_filters("pingpress_{$this->postType}_admin_column_value", $this->listValuesColumns($post_id));
        foreach($values as $key => $value) {
            if ($column == $key) {
                echo esc_html($value);
            }
        }
    }
}