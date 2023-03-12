<?php

namespace Inc\Module;

if (! defined('ABSPATH')) {
    exit;
}

final class ColumnAdminModule
{    
    /**
     * addColumns
     * Ajoute des colonnes dans la liste d'un post / custom post type
     *
     * @param  array $datas
     * @return array
     */
    public function addColumns(array $datas): array
    {
        return $datas;
    }
    
    /**
     * removeColumns
     *
     * @param  array $columns
     * @param  array $excludes
     * @return array
     */
    public function removeColumns(array $columns, array $excludes = []): array
    {
        return array_diff($columns, $excludes);
    }
}
