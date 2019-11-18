<?php 

namespace Pingu\Devel\Collectors;

use DebugBar\DataCollector\DataCollector;
use DebugBar\DataCollector\Renderable;
use Pingu\Forms\Support\Form;

class FormCollector extends DataCollector implements Renderable
{
    protected $forms = [];

    public function addForm(Form $form)
    {
        $this->forms[$form->getName()] = $form;
    }

    public function collect()
    {
        return [
            'forms' => $this->forms,
            'nb_forms' => sizeof($this->forms)
        ];
    }

    public function getName()
    {
        return 'forms';
    }

    public function getWidgets()
    {
        return array(
            "forms" => array(
                "icon" => "square-o",
                'widget' => 'PhpDebugBar.Widgets.FormsWidget',
                'map' => 'forms',
                'default' => '[]'
            ),
            'forms:badge' => [
                'map' => 'forms.nb_forms',
                'default' => 0
            ]
        );
    }
}