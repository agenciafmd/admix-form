<?php

use Agenciafmd\Form\Components as CustomComponents;
use ProtoneMedia\LaravelFormComponents\Components;

/*
 * esse arquivo sobrescrever/complementa o
 * vendor/protonemedia/laravel-form-components/config/config.php
 * */

return [
    'framework' => 'bootstrap-4',

    'components' => [
//
//        'form-checkbox' => [
//            'view' => 'form-components::{framework}.form-checkbox',
//            'class' => Components\FormCheckbox::class,
//        ],
//
//        'form-errors' => [
//            'view' => 'form-components::{framework}.form-errors',
//            'class' => Components\FormErrors::class,
//        ],
//
//        'form-group' => [
//            'view' => 'form-components::{framework}.form-group',
//            'class' => Components\FormGroup::class,
//        ],
//
//        'form-input' => [
//            'view' => 'form-components::{framework}.form-input',
//            'class' => Components\FormInput::class,
//        ],
//
        'form-label' => [
            'view' => 'form-components::{framework}.form-label',
            'class' => Components\FormLabel::class,
        ],
//
//        'form-radio' => [
//            'view' => 'form-components::{framework}.form-radio',
//            'class' => Components\FormRadio::class,
//        ],
//
//        'form-select' => [
//            'view' => 'form-components::{framework}.form-select',
//            'class' => Components\FormSelect::class,
//        ],
//
//        'form-submit' => [
//            'view' => 'form-components::{framework}.form-submit',
//            'class' => Components\FormSubmit::class,
//        ],
//
//        'form-textarea' => [
//            'view' => 'form-components::{framework}.form-textarea',
//            'class' => Components\FormTextarea::class,
//        ],

        // admix
        'form' => [
            'view' => 'agenciafmd/form::{framework}.form',
            'class' => CustomComponents\Form::class,
        ],

        'form-input' => [
            'view' => 'agenciafmd/form::{framework}.form-input',
            'class' => CustomComponents\FormInput::class,
        ],

        'form-text' => [
            'view' => 'agenciafmd/form::{framework}.form-input',
            'class' => CustomComponents\FormText::class,
        ],

        'form-password' => [
            'view' => 'agenciafmd/form::{framework}.form-input',
            'class' => CustomComponents\FormPassword::class,
        ],

        'form-email' => [
            'view' => 'agenciafmd/form::{framework}.form-input',
            'class' => CustomComponents\FormEmail::class,
        ],

        'form-select' => [
            'view' => 'agenciafmd/form::{framework}.form-select',
            'class' => CustomComponents\FormSelect::class,
        ],

        'form-is-active' => [
            'view' => 'agenciafmd/form::{framework}.form-select',
            'class' => CustomComponents\FormIsActive::class,
        ],

        'form-image' => [
            'view' => 'agenciafmd/form::{framework}.form-image',
            'class' => CustomComponents\FormImage::class,
        ],

        'form-invalid-feedback' => [
            'view' => 'agenciafmd/form::{framework}.form-invalid-feedback',
            'class' => CustomComponents\FormInvalidFeedback::class,
        ],

        'form-help' => [
            'view' => 'agenciafmd/form::{framework}.form-help',
            'class' => CustomComponents\FormHelp::class,
        ],

        'filter-input' => [
            'view' => 'agenciafmd/form::{framework}.filter-input',
            'class' => CustomComponents\FilterInput::class,
        ],

        'filter-text' => [
            'view' => 'agenciafmd/form::{framework}.filter-input',
            'class' => CustomComponents\FilterText::class,
        ],

        'filter-select' => [
            'view' => 'agenciafmd/form::{framework}.filter-select',
            'class' => CustomComponents\FilterSelect::class,
        ],

        'batch-select' => [
            'view' => 'agenciafmd/form::{framework}.batch-select',
            'class' => CustomComponents\BatchSelect::class,
        ],

    ],
];