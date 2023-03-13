<div class="invalid-feedback">
    @if($errors->admix->has($dottedName))
        {{ ucfirst($errors->admix->first($dottedName)) }}
    @else
        o campo {{ strtolower($label) }} é obrigatório
    @endif
</div>
