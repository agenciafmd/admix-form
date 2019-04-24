@if($helper)
    <small id="{{ $name }}Help" class="mt-2 form-text col text-muted">
        {{ str_limit($helper, 60, '') }}
    </small>
@endif