<?php

namespace Pingu\Devel\Listeners;

class AddViewNamesHelper
{
    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle($event)
    {
        if (config('devel.showViewNames')) {
            $event->html = view()->make('devel@view-names-helper', [
                'current' => $event->view->getName(),
                'views' => $event->renderer->getViews()
            ])->render() . $event->html;
        }
    }
}
