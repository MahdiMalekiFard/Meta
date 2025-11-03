@props(['city'])
<div class="group rounded-xl bg-white dark:bg-slate-900 shadow hover:shadow-xl dark:hover:shadow-xl dark:shadow-gray-700 dark:hover:shadow-gray-700 overflow-hidden ease-in-out duration-500">
    <a href="{{route('estate.index',['city_id'=>$city->id])}}">
        <div class="p-4">
            <p class="text-md font-medium hover:text-green-600 text-1-line text-center">{{$city->title}}</p>
            <div class="flex justify-between">
                <p class="text-slate-400 text-sm">{{__('core.rent')}}: {{$city->estates_rent_count}}</p>
                <p class="text-slate-400 text-sm">{{__('core.sale')}}: {{$city->estates_sale_count}}</p>
            </div>
        </div>
    </a>
</div>
