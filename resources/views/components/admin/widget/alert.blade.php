@props([
    'class'=>null,
    'type'=>'primary',
    'icon'=>'fa-check-circle',
    'title'=>null,
    'message'=>'',
])
<div @class(['alert d-flex align-items-center p-5','alert-'.$type,$class])>
    <i @class(['fa fs-2hx me-4','text-'.$type,$icon])></i>

    <div class="d-flex flex-column">
       @if($title)
            <h4 @class(["mb-1","text-".$type])>{!! $title !!}</h4>
       @endif

        <span>{!! $message !!}</span>
    </div>
</div>