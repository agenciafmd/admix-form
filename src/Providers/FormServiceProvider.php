<?php

namespace Agenciafmd\Form\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class FormServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViews();

        $this->loadTranslations();

        $this->loadComponents();
    }

    public function register()
    {
        //
    }

    protected function loadViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'agenciafmd/form');
    }

    protected function loadTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'agenciafmd/form');
    }

    protected function loadComponents()
    {
        Form::component('bsOpen', 'agenciafmd/form::components.form.open', [
            'params' => [],
        ]);

        Form::component('bsText', 'agenciafmd/form::components.form.generic', [
            'label',
            'name',
            'value' => null,
            'attributes' => [],
            'helper' => null,
            'type' => 'text'
        ]);

        Form::component('bsEmail', 'agenciafmd/form::components.form.generic', [
            'label',
            'name',
            'value' => null,
            'attributes' => [],
            'helper' => null,
            'type' => 'email'
        ]);

        Form::component('bsPassword', 'agenciafmd/form::components.form.password', [
            'label',
            'name',
            'attributes' => [],
            'helper' => null
        ]);

        Form::component('bsSelect', 'agenciafmd/form::components.form.select', [
            'label',
            'name',
            'options' => [],
            'value' => null,
            'attributes' => [],
            'helper' => null
        ]);

        Form::component('bsIsActive', 'agenciafmd/form::components.form.select', [
            'label',
            'name',
            'value' => null,
            'attributes' => [],
            'helper' => null,
            'options' => [
                '' => '-',
                '1' => 'Sim',
                '0' => 'Não',
            ],
        ]);

        Form::component('bsBoolean', 'agenciafmd/form::components.form.select', [
            'label',
            'name',
            'value' => null,
            'attributes' => [],
            'helper' => null,
            'options' => [
                '' => '-',
                '1' => 'Sim',
                '0' => 'Não',
            ],
        ]);

        Form::component('bsImage', 'agenciafmd/form::components.form.image', [
            'label',
            'name',
            'value' => null,
            'attributes' => [],
            'helper' => null,
        ]);
    }
}
