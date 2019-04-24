<div class="invalid-feedback">
    @if($errors->admix->has($name))
        {{ ucfirst($errors->admix->first($name)) }}
    @else
        o campo {{ strtolower($label) }} é obrigatório
    @endif
</div>
