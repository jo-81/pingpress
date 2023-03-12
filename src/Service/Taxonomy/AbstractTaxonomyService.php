<?php

namespace Pingpress\Service\Taxonomy;

use Inc\Module\PageModule;
use Inc\Module\TaxonomyModule;

if (! defined('ABSPATH')) {
    exit;
}

abstract class AbstractTaxonomyService
{
    public function __construct(protected TaxonomyModule $taxonomyModule, protected PageModule $pageModule)
    {}

    abstract public function registerTaxonomy(): void;
}