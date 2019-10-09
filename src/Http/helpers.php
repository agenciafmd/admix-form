<?php

if (!function_exists('attributesToString')) {
    function attributesToString(array $attributes): string
    {
        return implode(' ', collect($attributes)->transform(function ($value, $key) {
            if (is_string($key)) {
                return "{$key}=\"$value\"";
            } else {
                return $value;
            }// else
        })->toArray());
    }// function attributesToString
}// if
