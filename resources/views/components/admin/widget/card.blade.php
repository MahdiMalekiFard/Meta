@props([
    'class'=>null,
    'card_body_class'=>null,
    'title'=>null,
    'actions'=>null,
    'footer'=>null,
])
<div @class(['card','shadow-sm',$class])>
    @if(@$title || @$actions)
        <div class="card-header">
            <h3 class="card-title">{!! @$title !!}</h3>
            <div class="card-toolbar">
                {{@$actions}}
            </div>
        </div>
    @endif

    <div @class(['card-body',$card_body_class])>
        <div class="row">
            {{$slot}}
        </div>
    </div>
    @if(@$footer)
        <div class="card-footer">
            {{$footer}}
        </div>
    @endif

</div>