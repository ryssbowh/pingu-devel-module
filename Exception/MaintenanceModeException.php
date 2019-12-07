<?php

namespace Pingu\Devel\Exception;

use Illuminate\Contracts\Support\Responsable;

class MaintenanceModeException extends \Illuminate\Foundation\Http\Exceptions\MaintenanceModeException implements Responsable
{
    /**
     * Create a new exception instance.
     *
     * @param $time
     * @param null            $retryAfter
     * @param null            $message
     * @param null            $view
     * @param \Exception|null $previous
     * @param int             $code
     */
    public function __construct($time, $retryAfter = null, $message = null, $view = null, \Exception $previous = null, $code = 0)
    {
        parent::__construct($time, $retryAfter, $message, $previous, $code);
        $this->view = config('devel.maintenance.view');
    }
    /**
     * Build a response for Laravel to show
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request)
    {
        $headers = array();
        $array = [
            'message' => $this->message
        ];
        if ($this->retryAfter) {
            $headers = array('Retry-After' => $this->retryAfter);
            $array['retryAfter'] = $this->retryAfter;
            $array['willBeAvailableAt'] = $this->willBeAvailableAt;
        }

        if ($request->expectsJson()) {
            return response($array, 503)->withHeaders($headers);
        }
        \Theme::setByName(config('core.frontTheme'));
        $view = view($this->view)->with($array);
        return response($view, 503)->withHeaders($headers);
    }
}