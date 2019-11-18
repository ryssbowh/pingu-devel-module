<?php

namespace Pingu\Devel\Forms;

use Pingu\Forms\Support\Fields\Submit;
use Pingu\Forms\Support\Form;

class MaintenanceModeOffForm extends Form
{

    /**
     * Fields definitions for this form, classes used here
     * must extend Pingu\Forms\Support\Field
     * 
     * @return array
     */
    public function elements(): array
    {
        return [
            new Submit(
                'submit',
                [
                    'label' => 'Turn maintenance mode off'
                ]
            )
        ];
    }

    /**
     * Method for this form, POST GET DELETE PATCH and PUT are valid
     * 
     * @return string
     */
    public function method(): string
    {
        return 'POST';
    }

    /**
     * Url for this form, valid values are
     * ['url' => '/foo.bar']
     * ['route' => 'login']
     * ['action' => 'MyController@action']
     * 
     * @return array
     * @see https://github.com/LaravelCollective/docs/blob/5.6/html.md
     */
    public function action(): array
    {
        return ['route' => 'devel.admin.maintenance.off'];
    }

    /**
     * Name for this form, ideally it would be application unique, 
     * best to prefix it with the name of the module it's for.
     * only alphanumeric and hyphens
     * 
     * @return string
     */
    public function name(): string
    {
        return 'devel-maintenanceModeOff';
    }

}