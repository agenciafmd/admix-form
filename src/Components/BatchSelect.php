<?php

namespace Agenciafmd\Form\Components;

use ProtoneMedia\LaravelFormComponents\Components\FormSelect as BaseFormSelect;

class BatchSelect extends BaseFormSelect
{
    public function __construct(string $name = 'batch', string $label = '', $options = [], $bind = null, $default = null, bool $multiple = false, bool $showErrors = true)
    {
        parent::__construct($name, $label, $options, $bind, $default, $multiple, $showErrors);
    }
}
