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
	public function fields()
	{
		return [
			'message' => [
				'field' => TextInput::class,
				'options' => [
					'helper' => 'If left blank, the message will be the one defined in settings'
				]
			],
			'retryAfter' => [
				'field' => NumberInput::class,
				'options' => [
					'label' => 'How long will the site be down (seconds)',
					'default' => config('core.maintenance.retryAfter'),
					'helper' => 'Defaulted to '.config('core.maintenance.retryAfter').' if left blank'
				]
			],
			'submit' => [
				'field' => Submit::class,
				'options' => [
					'label' => 'Turn maintenance mode on'
				]
			]
		];
	}

	/**
	 * Method for this form, POST GET DELETE PATCH and PUT are valid
	 * 
	 * @return string
	 */
	public function method()
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
	public function url()
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
	public function name()
	{
		return 'devel-maintenanceModeOn';
	}
}