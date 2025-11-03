@php use App\ExtraAttributes\BlogExtraEnum;use App\Helpers\DateHelper; @endphp
<div class="group relative h-fit hover:-mt-[5px] overflow-hidden bg-white dark:bg-slate-900 rounded-xl shadow dark:shadow-gray-700 transition-all duration-500">
    <div class="relative overflow-hidden">
        <a href="{{route('blog.show',$blog->slug)}}">
            <img src="{{loadMedia($blog,'image','480')}}" class="" alt="">
        </a>
        <div class="absolute end-4 top-4">
            @foreach($blog->categories()->limit(2)->get() as $item)
                <span class="bg-green-600 text-white text-[14px] px-2.5 py-1 font-medium rounded-full h-5 text-1-line">
                    <a href="#">{{Str::limit($item->title,30)}}</a>
                </span>
            @endforeach
        </div>
    </div>

    <div class="relative p-6">
        <div class="">
            <div class="flex justify-between mb-4">
                <span class="text-slate-400 text-sm"><i class="uil uil-calendar-alt text-slate-900 dark:text-white me-2"></i>{{DateHelper::format($blog->created_at)}}</span>
                <span class="text-slate-400 text-sm ms-3"><i class="uil uil-clock text-slate-900 dark:text-white me-2"></i>{{$blog->extra_attributes->get(BlogExtraEnum::READING_TIME->value,5)}} Min</span>
            </div>

            <a href="{{route('blog.show',$blog->slug)}}" class="title text-xl font-medium hover:text-green-600 duration-500 ease-in-out text-2-line">{{$blog->title}}</a>

            <div class="mt-3">
                <a href="{{route('blog.show',$blog->slug)}}" class="btn btn-link hover:text-green-600 after:bg-green-600 duration-500 ease-in-out">Read More <i class="uil uil-arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>
                        