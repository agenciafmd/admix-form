<div class="form-group {{ $errors->{$bag}->has($name) ? ' has-error' : '' }}">
    @label([$label, $name, ['class' => 'form-label']])
    {{ $input }}
    @invalidFeedback([$name, $label])
</div>
