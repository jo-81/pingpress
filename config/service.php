<?php
// Retourne la définition des différents services utilisé par php di


use Pingpress\Service\DashboardService;

return [
    'dashboard.service' => DI\create(DashboardService::class)->constructor(DI\get('page.module')),
];
