@props([
    'id'=>'form',
    'action'=>'',
    'method'=>'POST',
    'validate'=>0,
    'multipart'=>0,
    'enable_ajax'=>1,
])

<form
    id="{{$id}}"
    action="{{$action}}"
    method="{{$method}}"
    @if(!$validate) novalidate @endif
    @if($multipart) enctype="multipart/form-data" @endif
    {{$attributes->merge(['class'=>$enable_ajax?'pro-ajax':''])}}>
    @csrf
    @if($method!="GET" && $method!="POST")
        @method(@$method)
    @endif
    {{$slot}}
</form>
