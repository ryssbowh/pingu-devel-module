<?php

namespace Pingu\Devel\Http\Controllers;

use Pingu\Core\Http\Controllers\BaseController;
use Pingu\Devel\Forms\MaintenanceModeOffForm;
use Pingu\Devel\Forms\MaintenanceModeOnForm;

class DevelMaintenanceController extends BaseController
{
    public function index()
    {
        if(app()->isDownForMaintenance()){
            $form = new MaintenanceModeOffForm();
        }
        else $form = new MaintenanceModeOnForm();

        return view('devel::maintenance')->with([
            'form' => $form,
            'maintenanceOff' => app()->isDownForMaintenance()
        ]);
    }

    public function maintenanceModeOn()
    {
        $message = $this->request->post()['message'];
        $retryAfter = $this->request->post()['retryAfter'];
        if(!$message) $message = config('core.maintenance.message');
        if(!$retryAfter) $retryAfter = config('core.maintenance.retryAfter');
        \Artisan::call('down',['--message' => $message, '--retry' => $retryAfter]);
        \Notify::success('Maintenance mode turned on');
        return redirect()->route('devel.admin.maintenance');
    }

    public function maintenanceModeOff()
    {
        \Artisan::call('up');
        \Notify::success('Maintenance mode turned off');
        return redirect()->route('devel.admin.maintenance');
    }
}
