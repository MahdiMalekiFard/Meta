@props([
    'form'=>'form',
    'backRoute'=>'#',
    'submitText'=>trans('general.submit'),
    'backText'=>trans('general.back'),
])
<div class="">
    <button type="submit" form="{{$form}}" class="btn btn-sm btn-primary">{{$submitText}}</button>
    <a href="{{$backRoute}}" class="btn btn-sm btn-secondary">{{$backText}}</a>
</div>