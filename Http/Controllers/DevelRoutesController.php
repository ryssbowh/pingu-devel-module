<?php

namespace Pingu\Devel\Http\Controllers;

use Pingu\Jsgrid\Fields\Select;
use Pingu\Jsgrid\Fields\Text;
use Pingu\Jsgrid\Http\Controllers\JsGridController;

class DevelRoutesController extends JsGridController
{
    public function listRoutes()
    {
        $jsGridOptions = $this->buildJsGridView();
        return view('devel::routes')->with([
            'jsgrid' => $jsGridOptions
        ]);
    }

    /**
     * The uri used by jsgrid to get data
     * 
     * @return string
     */
    protected function getJsGridData()
    {
        $out = [];
        foreach(\Route::getRoutes()->getRoutes() as $route){
            $item = [
                'uri' => $route->uri,
                'method' => $route->methods[0],
                'name' => $route->action['as'] ?? '',
            ];
            $out[] = $item;
        }
        return $out;
    }

    protected function getJsGridOptions()
    {
        return [
            'editing' => false,
            'inserting' => false
        ];
    }

    /**
     * Unique name for this instance
     * 
     * @return string
     */
    protected function jsGridInstanceName()
    {
        return 'develRoutes';
    }

    protected function getJsGridFields()
    {
        return [
            [
                'name' => 'uri',
                'type' => 'text',
                'title' => 'Uri'
            ],
            [
                'name' => 'name',
                'type' => 'text',
                'title' => 'Name'
            ],
            [
                'name' => 'method',
                'type' => 'select',
                'title' => 'Method',
                'valueField' => 'id',
                'textField' => 'title',
                'items' => [
                    ['id' => 'GET',
                    'title' => 'Get'],
                    ['id' => 'POST',
                    'title' => 'Post'],
                    ['id' => 'DELETE',
                    'title' => 'Delete'],
                    ['id' => 'PATCH',
                    'title' => 'Patch'],
                    ['id' => 'PUT',
                    'title' => 'Put']
                ]
            ]
        ];
    }

    protected function controls()
    {
        return [];
    }
}
