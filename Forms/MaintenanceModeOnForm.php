<?php

namespace Pingu\Devel\Forms;

use Pingu\Forms\Support\Fields\NumberInput;
use Pingu\Forms\Support\Fields\Submit;
use Pingu\Forms\Support\Fields\TextInput;
use Pingu\Forms\Support\Form;

class MaintenanceModeOnForm extends Form
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
            new TextInput(
                'message',
                [
                    'helper' => 'If left blank, the message will be the one defined in settings'
                ]
            ),
            new NumberInput(
                'retryAfter',
                [
                    'label' => 'How long will the site be down (seconds)',
                    'default' => config('devel.maintenance.retryAfter'),
                    'helper' => 'Defaulted to '.config('devel.maintenance.retryAfter').' if left blank'
                ]
            ),
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
        return ['route' => 'devel.admin.maintenance.on'];
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
        return 'devel-maintenanceModeOn';
    }
}