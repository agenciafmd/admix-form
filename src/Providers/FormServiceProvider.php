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
        Blade::directive('formClose', function ($expression) {
            return "<?php echo '</form>'; ?>";
        });

        Blade::include('agenciafmd/form::includes.label', 'inputLabel');
        
        Blade::include('agenciafmd/form::includes.input.types.text', 'inputText');
        Blade::include('agenciafmd/form::includes.input.types.email', 'inputEmail');
        Blade::include('agenciafmd/form::includes.input.types.number', 'inputNumber');
        Blade::include('agenciafmd/form::includes.input.types.password', 'inputPassword');
        Blade::include('agenciafmd/form::includes.input.types.date', 'inputDate');
        Blade::include('agenciafmd/form::includes.input.types.time', 'inputTime');
        Blade::include('agenciafmd/form::includes.input.types.datetime', 'inputDateTime');
        Blade::include('agenciafmd/form::includes.input.types.tel', 'inputTel');
        Blade::include('agenciafmd/form::includes.input.types.color', 'inputColor');
        Blade::include('agenciafmd/form::includes.select.types.common', 'inputSelect');
        Blade::include('agenciafmd/form::includes.select.types.is-active', 'inputIsActive');
        Blade::include('agenciafmd/form::includes.select.types.boolean', 'inputBoolean');
        Blade::include('agenciafmd/form::includes.select.types.boolean', 'inputBoolean');
        Blade::include('agenciafmd/form::includes.textarea.types.wysiwyg', 'inputTextarea');
        Blade::include('agenciafmd/form::includes.textarea.types.plain', 'inputTextareaPlain');

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
