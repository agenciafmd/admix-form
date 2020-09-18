<?php

namespace Agenciafmd\Form\Components;

use \ProtoneMedia\LaravelFormComponents\Components\FormSelect as BaseFormSelect;

class FilterSelect extends BaseFormSelect
{
    public function isSelected($key): bool
    {
        if ($this->isWired()) {
            return false;
        }

        if ($this->selectedKey == $key) {
            return true;
        }

        if (is_array($this->selectedKey) && in_array($key, $this->selectedKey)) {
            return true;
        }

        return false;
    }
}
