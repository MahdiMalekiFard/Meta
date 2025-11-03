@props(['category'])
<div class="group rounded-xl bg-white dark:bg-slate-900 shadow hover:shadow-xl dark:hover:shadow-xl dark:shadow-gray-700 dark:hover:shadow-gray-700 overflow-hidden ease-in-out duration-500">
    <a href="{{route('service.index',['category_id'=>$category->id])}}">
        <img src="{{loadMedia($category,'image',480)}}" alt="">
        <div class="p-4">
            <p class="text-md font-medium hover:text-green-600 text-1-line">{{$category->title}}</p>
            <p class="text-slate-400 text-sm mt-1">{{$category->services_count}} service</p>
        </div>
    </a>
</div>
