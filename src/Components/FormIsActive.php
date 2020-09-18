<?php

namespace Agenciafmd\Form\Components;


class FormIsActive extends FormSelect
{
    public function __construct(
        string $name = 'is_active',
        string $label = 'Ativo',
        $options = [
            '' => '-',
            '1' => 'Sim',
            '0' => 'Não',
        ],
        $bind = null,
        $default = null,
        bool $multiple = false,
        bool $showErrors = true
    )
    {
        parent::__construct($name, $label, $options, $bind, $default, $multiple, $showErrors);
    }
}
