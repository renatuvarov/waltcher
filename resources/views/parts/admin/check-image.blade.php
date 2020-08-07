@if($errors->count() > 0)
    @if(! empty(old('images')))
        @foreach(old('images') as $image)
            <input type="hidden" class="new-image" name="images[]" value="{{ $image }}">
        @endforeach
    @endif
    @if(! empty(old('for_removing')))
        @foreach(old('for_removing') as $image)
            <input type="hidden" name="for_removing[]" value="{{ $image }}">
        @endforeach
    @endif
@endif
