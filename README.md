# Devel Module

## Maintenance mode
maintenance mode can be enabled by a command. Or by the front end if your have the Devel module installed.
default laravel middleware has been overwritten to allow /login to be accessible and to allow users with permissions 'use site in maintenance mode' to use the site normally.
Message, retry after and view defined in config.

the `CheckFormaintenanceMode` does what its name says. /login will always be available. Users can use the site if they have the permission use site in maintenance mode'.

## Debug bar
Will add the laravel debug bar https://github.com/barryvdh/laravel-debugbar through the middleware `ActivateDebugBar`.
This is permission controlled but will always show when env is 'local'

## Routes
List all the routes in a filterable dashboard