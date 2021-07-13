<form method="{{ $spoofMethod ? 'POST' : $method }}" @if($enctype !== '') enctype="{{$enctype}}" @endif
{!! $attributes !!}>
@unless(in_array($method, ['HEAD', 'GET', 'OPTIONS']))
    @csrf
@endunless

@if($spoofMethod)
    @method($method)
@endif

    {!! $slot !!}
</form>
