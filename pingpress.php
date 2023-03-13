<?php

/**
 * Plugin Name:       PingPress
 * Description:       Gérez votre club de tennis de table : joueurs, équipes, évènements, classements, ...
 * Version:           0.0.1
 * Requires at least: 6.1.1
 * Requires PHP:      8.1
 * Author:            Geoffroy Colpart
 * Text Domain:       pingpress
 */

use DI\ContainerBuilder;
use Pingpress\Pingpress;
use Inc\Service\ContainerService;
use Pingpress\Controller\ModuleController;
use Pingpress\Controller\TaxonomyController;
use Pingpress\Controller\DashboardController;
use Pingpress\Controller\EnqueueController;
use Pingpress\Controller\OptionController;
use Pingpress\Controller\PlayerController;
use Pingpress\Controller\TeamController;

if (! defined('ABSPATH')) {
    exit;
}

$autoload = WP_PLUGIN_DIR . "/pingpress/vendor/autoload.php";
if (!file_exists($autoload)) {
    throw new Exception(__("Le fichier d'autoload n'existe pas", "pingpress"));
}
require_once $autoload;

$constantes = WP_PLUGIN_DIR . "/pingpress/constantes.php";
if (!file_exists($constantes)) {
    throw new Exception(__("Le fichier constantes.php n'existe pas", "pingpress"));
}

require_once $constantes;

$functions = WP_PLUGIN_DIR . "/pingpress/src/functions.php";
if (!file_exists($functions)) {
    throw new Exception(__("Le fichier functions.php n'existe pas", "pingpress"));
}

require_once $functions;

$configurations = apply_filters('pingpress_configurations', [WP_PLUGIN_DIR . "/pingpress/config"]);

// Récupération de la configuration pour le container
$container = new ContainerService(new ContainerBuilder);
$container->setConfigurations($configurations);

// Activation du plugin
$pingpress = new Pingpress;
$pingpress
    ->addController(EnqueueController::class)
    ->addController(OptionController::class)
    ->addController(DashboardController::class)
    ->addController(TaxonomyController::class)
    ->addController(ModuleController::class)
    ->addController(PlayerController::class)
    ->addController(TeamController::class)
;


$pingpress->start();