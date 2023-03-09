<?php

namespace Pingpress\Service;

use Inc\Module\OptionModule;
use Inc\Service\MessageService;

if (! defined('ABSPATH')) {
    exit;
}

final class OptionService
{

    public function __construct(private OptionModule $optionModule)
    {}
    
    /**
     * isSubmitForm
     *
     * @param  string $nonce
     * @return bool
     */
    public function isSubmitForm(string $nonce): bool
    {
        return ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST[$nonce . '_field']) && wp_verify_nonce($_POST[$nonce . '_field'], $nonce . '_action'));
    }

    /**
     * registerOptions
     *
     * @return void
     */
    public function registerOptions(): void
    {
        if (! $this->isSubmitForm(OPTION_MODULE_NONCE)) {
            return;
        }

        $redirection = sanitize_text_field($_POST['_wp_http_referer']);
        $result = 0;
        foreach ($_POST as $key => $post) {
            if (! str_contains($key, 'pp_')) {
                continue;
            }

            if (empty($post)) {
                $isRegistered = $this->optionModule->registerOptions($key, '');
            } else {
                $isRegistered = $this->optionModule->registerOptions($key, $_POST[$key]);
            }

            if ($isRegistered) {
                $result++;
            }
        }

        if ($result > 0) {
            MessageService::add('pingpress_option_message', ['message' => __('Les informations ont bien été sauvegardées', 'pingpress')]);
        }

        wp_safe_redirect($redirection);
        die;
    }
}
