<?php

return [
    'name' => 'Devel',
    /**
     * Maintenance mode config
     */
    'maintenance' => [
        'view' => 'core@maintenance-mode',
        'retryAfter' => '1800',
        'message' => 'This site is in maintenance, please try again later',
        'usableRoutes' => ['user.login', 'user.logout', 'user.showLoginForm']
    ],
    'showViewNames' => true
];
