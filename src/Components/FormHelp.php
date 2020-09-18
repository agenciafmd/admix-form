<?php

namespace Agenciafmd\Form\Components;

use ProtoneMedia\LaravelFormComponents\Components\Component;

class FormHelp extends Component
{
    public string $name;
    public string $message;

    public function __construct(string $name, string $message = '')
    {
        $this->name = $name;
        $this->message = $message;
    }
}
