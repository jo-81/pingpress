<?php

namespace Pingpress\Controller;


if (! defined('ABSPATH')) {
    exit;
}

final class OptionController extends AbstractController
{
    public function __invoke()
    {
        if (is_admin()) {
            add_action('init', [$this->get('option.service'), 'registerOptions']);
        }
    }
}
