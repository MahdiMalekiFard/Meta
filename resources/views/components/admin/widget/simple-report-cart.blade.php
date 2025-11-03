@props([
    'icon'=>'fa-user',
    'count'=>'0',
    'title'=>'---',
    'growth_rate'=>null,
])
<div class="col-sm-6 col-xl-2 mb-xl-10">
    <div class="card h-lg-100">
        <div class="card-body d-flex justify-content-between align-items-start flex-column">
            <div class="m-0">
                <i class="fa-duotone {{$icon}} fs-2hx text-gray-600"></i>
            </div>
            <div class="d-flex flex-column my-7">
                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">{{$count}}</span>
                <div class="m-0">
                    <span class="fw-semibold fs-6 text-gray-400">{{$title}}</span>
                </div>
            </div>
            @if($growth_rate)
                <span class="badge badge-light-success fs-base">
													<i class="ki-duotone ki-arrow-{{$growth_rate>0?'up':'down'}} fs-5 text-{{$growth_rate>0?'success':'danger'}} ms-n1">
														<span class="path1"></span>
														<span class="path2"></span>
													</i>{{$growth_rate}}%</span>
            @endif
        </div>
    </div>
</div>