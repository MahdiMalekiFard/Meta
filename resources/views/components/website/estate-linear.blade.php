@php use App\Enums\EstatePurposeEnum; @endphp

<div class="group rounded-xl bg-white dark:bg-slate-900 shadow hover:shadow-xl dark:hover:shadow-xl dark:shadow-gray-700 dark:hover:shadow-gray-700 overflow-hidden ease-in-out duration-500 w-full mx-auto lg:max-w-2xl">
    <a href="{{route('estate.show',$estate->slug)}}">
        <div class="md:flex">
            <div class="relative md:shrink-0">
                <img class="h-full w-full object-cover md:w-48" src="{{loadMedia($estate,'image','480')}}" alt="">
                <div class="absolute top-4 end-4">
                    <a href="{{route('like',['type'=>'estate','id'=>$estate->id])}}"
                       data-pro-after="likeBtn"
                        @class([
                             'pro-ajax btn btn-icon bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 rounded-full hover:text-red-600 dark:hover:text-red-600',
                             'text-slate-100 dark:text-slate-700'=>!$estate->isLiked(),
                             'text-red-600'=>$estate->isLiked(),
                         ])>
                        <i class="mdi mdi-heart text-[20px]"></i></a>
                </div>
                <div class="absolute top-4 start-4">
                    <p class="btn btn-sm bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 text-red-600 dark:text-red-600">@if($estate->purpose==EstatePurposeEnum::SALE)
                            {{__('core.for_sale')}}
                        @else
                            {{__('core.for_rent')}}
                        @endif</p>
                </div>
            </div>
            <div class="p-6">
                <div class="md:pb-4 pb-6">
                    <a href="{{route('estate.show',$estate->slug)}}" class="text-lg hover:text-green-600 font-medium ease-in-out duration-500 text-2-line">{{$estate->title}}</a>
                </div>

                <ul class="md:py-4 py-6 border-y border-slate-100 dark:border-gray-800 flex items-center list-none">
                    <li class="flex items-center me-4">
                        <i class="uil uil-compress-arrows text-2xl me-2 text-green-600"></i>
                        <span>{{__('estate.area_meter', ['meter' => $estate->area_meter])}}</span>
                    </li>

                    <li class="flex items-center me-4">
                        <i class="uil uil-bed-double text-2xl me-2 text-green-600"></i>
                        <span>{{__('estate.bed_count', ['count' => $estate->bedrooms_count])}}</span>
                    </li>

                    <li class="flex items-center">
                        <i class="uil uil-bath text-2xl me-2 text-green-600"></i>
                        <span>{{__('estate.bath_count', ['count' => $estate->bathrooms_count])}}</span>
                    </li>
                </ul>

                <ul class="md:pt-4 pt-6 flex justify-between items-center list-none">
                    @if($estate->purpose===EstatePurposeEnum::SALE)
                        <li>
                            <span class="text-slate-400">{{__('validation.attributes.price')}}</span>
                            <p class="text-sm font-light"> {{number_format($estate->price)}}</p>
                        </li>
                    @else
                        <li>
                            <span class="text-slate-400">{{__('validation.attributes.mortgage')}}</span>
                            <p class="text-sm font-light">{{number_format($estate->mortgage)}}</p>
                        </li>
                        <li>
                            <span class="text-slate-400">{{__('validation.attributes.rent')}}</span>
                            <p class="text-sm font-light">{{number_format($estate->rent)}}</p>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </a>
</div>
