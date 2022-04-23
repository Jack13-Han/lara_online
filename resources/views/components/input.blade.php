<div class="mb-3">
    <label for="" class="form-label">{{$inputTitle}}</label>
    <input type="{{$type}}" @if($formId) form="{{$formId}}" @endif class="form-control @error($name) is-invalid @enderror "

           @isset($value)
           value="{{ old($name,$value) }}"
           @else
               value="{{old($name)}}"
           @endisset

           name="{{$name}}">

    @error($name)
    <p class="text-danger small">{{$message}}</p>
    @enderror
</div>
