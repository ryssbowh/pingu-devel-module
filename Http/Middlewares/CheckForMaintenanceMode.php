<?php

namespace Pingu\Devel\Http\Middlewares;

use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Pingu\Devel\Exception\MaintenanceModeException;

class CheckForMaintenanceMode
{
    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application $app
     * @return void
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $route = $request->route();
        $usableRoute = ($route->getName() and in_array($route->getName(), config('devel.maintenance.usableRoutes')));
        $hasPerm = \Permissions::getPermissionableModel()->hasPermissionTo('view site in maintenance mode');

        // dump($route->getName());
        // dump($hasPerm);

        if ($this->app->isDownForMaintenance() and !$usableRoute and !$hasPerm) {
            $data = json_decode(file_get_contents($this->app->storagePath().'/framework/down'), true);

            throw new MaintenanceModeException($data['time'], $data['retry'], $data['message']);
        }

        return $next($request);
    }
}
