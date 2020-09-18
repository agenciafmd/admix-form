<?php

namespace Agenciafmd\Form\Components;

class FormEmail extends FormInput
{
    public function __construct(
        string $name,
        string $label = '',
        string $type = 'email',
        $bind = null,
        $default = null,
        $language = null,
        bool $showErrors = true)
    {
        parent::__construct($name, $label, $type, $bind, $default, $language, $showErrors);
    }
}
