@props([
    'class'=>null,
    'card_body_class'=>null,
    'title'=>null,
    'value'=>0,
    'symbol'=>null,
    'ratio'=>null,
    'ratio_sign'=>'up',//up-down
    'chart_data'=>[]
])


<div class="card overflow-hidden h-md-50 mb-5 mb-xl-10 {{$class}}">
    <div class="card-body d-flex justify-content-between flex-column px-0 pb-0 {{$card_body_class}}">
        <div class="mb-4 px-9">
            <div class="d-flex align-items-center mb-2">
                @if($symbol)
                    <span class="fs-4 fw-semibold text-gray-400 align-self-start me-1&gt;">{{$symbol}}</span>
                @endif
                <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1">{{$value}}</span>
               @if($ratio)
                        <span class="badge badge-light-success fs-base"><i class="fad fa-arrow-{{$ratio_sign}} fs-5 text-success ms-n1"></i>{{$ratio}}</span>
               @endif
            </div>
            <span class="fs-6 fw-semibold text-gray-400">{{$title}}</span>
        </div>
        <div id="kt_card_widget_8_chartaa" class="min-h-auto" style="height: 125px"></div>
    </div>
</div>