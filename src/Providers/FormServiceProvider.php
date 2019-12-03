<?php

namespace Agenciafmd\Form\Providers;

use Form;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class FormServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadConfigs();

        $this->loadViews();

        $this->loadTranslations();

        $this->loadComponents();

        $this->app->singleton('form-model', function () {
            return collect();
        });
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

    protected function loadConfigs()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/forms.php', 'admix.forms');
    }

    protected function loadComponents()
    {
        Blade::include('agenciafmd/form::includes.form-open', 'formOpen');
        Blade::include('agenciafmd/form::includes.form-model', 'formModel');
        Blade::directive('formClose', function ($expression) {
            return "<?php echo '</form>'; ?>";
        });
        Blade::include('agenciafmd/form::includes.label', 'label');
        Blade::include('agenciafmd/form::includes.invalid-feedback', 'invalidFeedback');
        Blade::include('agenciafmd/form::includes.helper', 'helper');

        Blade::include('agenciafmd/form::includes.input.types.text', 'inputText');
        Blade::include('agenciafmd/form::includes.input.types.email', 'inputEmail');
        Blade::include('agenciafmd/form::includes.input.types.number', 'inputNumber');
        Blade::include('agenciafmd/form::includes.input.types.password', 'inputPassword');
        Blade::include('agenciafmd/form::includes.input.types.hidden', 'inputHidden');
        Blade::include('agenciafmd/form::includes.input.types.date', 'inputDate');
        Blade::include('agenciafmd/form::includes.input.types.time', 'inputTime');
        Blade::include('agenciafmd/form::includes.input.types.datetime', 'inputDateTime');
        Blade::include('agenciafmd/form::includes.input.types.tel', 'inputTel');
        Blade::include('agenciafmd/form::includes.input.types.color', 'inputColor');
        Blade::include('agenciafmd/form::includes.input.types.checkbox', 'inputCheckbox');
        Blade::include('agenciafmd/form::includes.input.types.image', 'inputImage');
        Blade::include('agenciafmd/form::includes.input.types.images', 'inputImages');
        Blade::include('agenciafmd/form::includes.input.types.media', 'inputMedia');
        Blade::include('agenciafmd/form::includes.input.types.medias', 'inputMedias');
        Blade::include('agenciafmd/form::includes.select.types.common', 'inputSelect');
        Blade::include('agenciafmd/form::includes.select.types.is-active', 'inputIsActive');
        Blade::include('agenciafmd/form::includes.select.types.boolean', 'inputBoolean');
        Blade::include('agenciafmd/form::includes.textarea.types.wysiwyg', 'inputTextarea');
        Blade::include('agenciafmd/form::includes.textarea.types.plain', 'inputTextareaPlain');

        Blade::include('agenciafmd/form::includes.group.types.text', 'formGroupText');
        Blade::include('agenciafmd/form::includes.group.types.email', 'formGroupEmail');
        Blade::include('agenciafmd/form::includes.group.types.password', 'formGroupPassword');

        Blade::include('agenciafmd/form::includes.inline.types.text', 'formText');
        Blade::include('agenciafmd/form::includes.inline.types.email', 'formEmail');
        Blade::include('agenciafmd/form::includes.inline.types.password', 'formPassword');
        Blade::include('agenciafmd/form::includes.inline.types.select', 'formSelect');
        Blade::include('agenciafmd/form::includes.inline.types.is-active', 'formIsActive');
        Blade::include('agenciafmd/form::includes.inline.types.image', 'formImage');
        Blade::include('agenciafmd/form::includes.inline.types.images', 'formImages');
        Blade::include('agenciafmd/form::includes.inline.types.media', 'formMedia');
        Blade::include('agenciafmd/form::includes.inline.types.medias', 'formMedias');

        Form::component('bsImage', 'agenciafmd/form::components.form.image', [
            'label',
            'name',
            'value' => null,
            'attributes' => [],
            'helper' => null,
        ]);

        Form::component('bsImages', 'agenciafmd/form::components.form.images', [
            'label',
            'name',
            'value' => null,
            'attributes' => [],
            'helper' => null,
        ]);

        Form::component('bsMedia', 'agenciafmd/form::components.form.media', [
            'label',
            'name',
            'value' => null,
            'attributes' => [],
            'helper' => null,
        ]);

        Form::component('bsMedias', 'agenciafmd/form::components.form.medias', [
            'label',
            'name',
            'value' => null,
            'attributes' => [],
            'helper' => null,
        ]);
    }
}
