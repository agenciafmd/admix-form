<?php

namespace Agenciafmd\Form\Components;

use ProtoneMedia\LaravelFormComponents\Components\Component;

class FormInvalidFeedback extends Component
{
    public string $name;
    public string $label;

    public function __construct(string $name, string $label)
    {
        $this->name = str_replace(['[', ']'], ['.', ''], $name);
        $this->label = $label;
    }
}
