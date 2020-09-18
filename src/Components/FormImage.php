<?php

namespace Agenciafmd\Form\Components;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use ProtoneMedia\LaravelFormComponents\Components\Component;
use ProtoneMedia\LaravelFormComponents\Components\HandlesDefaultAndOldValue;
use ProtoneMedia\LaravelFormComponents\Components\HandlesValidationErrors;

class FormImage extends Component
{
    use HandlesValidationErrors;
    use HandlesDefaultAndOldValue;

    public string $name;
    public string $label;
    public string $help;

    public $readOnly;
    public $value;
    public $image;

    public function __construct(
        string $name,
        string $label = '',
        string $help = '',
        $bind = null,
        $default = null,
        $language = null,
        bool $showErrors = true
    )
    {
        $this->name = $name;
        $this->label = $label;
        $this->help = $help;
        $this->showErrors = $showErrors;

        $bind = $this->getBind($name, $bind);
        $this->value = $bind;

        if ($language) {
            $this->name = "{$name}[{$language}]";
        }

        $this->setImage($name, $bind);
    }

    private function setImage($name, $bind)
    {
        $modelName = Str::lower(class_basename($bind));
        $field = config("upload-configs.{$modelName}.{$name}.sources.0");

        $this->image['width'] = $field['width'] ?? 800;
        $this->image['height'] = $field['height'] ?? 600;
        $this->image['quality'] = $field['quality'] ?? 95;
        $this->image['crop'] = $field['crop'] ?? false;
        $this->image['conversion'] = $field['conversion'] . '@2x';

        $this->label = $this->label . " ({$this->image['width']}x{$this->image['height']})";
    }

    private function getBind(string $name, $bind = null)
    {
        if ($bind === false) {
            $this->value = null;
        }

        return ($this->value = $bind ?: $this->getBoundTarget());
    }
}
