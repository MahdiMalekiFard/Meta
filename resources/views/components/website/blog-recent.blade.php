@php use App\Helpers\DateHelper; @endphp
@props([
    'item'
])
<a href="{{route('blog.show',$item->slug)}}">
    <div class="flex items-center mt-4">
        <img src="{{loadMedia($item,'image','thumb')}}" class="h-16 rounded-md shadow dark:shadow-gray-800 cursor-pointer" alt="">

        <div class="ms-3">
            <p class="font-medium hover:text-green-600">{{$item->title}}</p>
            <p class="text-sm text-slate-400">{{DateHelper::format($item->created_at)}}</p>
        </div>
    </div>
</a>