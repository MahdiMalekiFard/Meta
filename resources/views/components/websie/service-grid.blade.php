<div class="group rounded-xl bg-white dark:bg-slate-900 shadow hover:shadow-xl dark:hover:shadow-xl dark:shadow-gray-700 dark:hover:shadow-gray-700 overflow-hidden ease-in-out duration-500 w-full mx-auto lg:max-w-2xl">
    <div class="md:flex">
        <div class="relative md:shrink-0">
            <a href="{{route('service.show',['service'=>$service->slug])}}"> <img class="h-full w-full object-cover md:w-48" src="{{loadMedia($service,'image','480')}}" alt=""></a>
            <div class="absolute top-4 end-4">
                <a href="{{route('like',['type'=>'service','id'=>$service->id])}}"
                   data-pro-after="likeBtn"
                    @class([
                             'pro-ajax btn btn-icon bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 rounded-full hover:text-red-600 dark:hover:text-red-600',
                             'text-slate-100 dark:text-slate-700'=>!$service->isLiked(),
                             'text-red-600'=>$service->isLiked(),
                         ])><i class="mdi mdi-heart text-[20px]"></i></a>
            </div>
        </div>
        <div class="p-6 w-full">
            <div class="md:pb-4 pb-6">
                <a href="{{route('service.show',['service'=>$service->slug])}}" class="text-lg hover:text-green-600 font-medium ease-in-out duration-500 text-1-line">{{$service->title}}</a>
            </div>

            <ul class="md:py-4 py-6 border-y border-slate-100 dark:border-gray-800 flex items-center list-none">
                <li class="flex items-center me-4">
                    <a href="https://wa.me/{{$service->city->province->country->code}}{{$service->mobile}}?text={{__('contactUs.default_whatsapp_message')}}"
                       class="btn btn-icon"
                    ><i class="uil uil-whatsapp text-2xl me-2 text-green-600"></i></a>
                </li>

                <li class="flex items-center me-4">
                    <a href="tel:{{$service->mobile}}" class="btn btn-icon"><i class="uil uil-phone text-2xl me-2 text-green-600"></i></a>
                </li>

                <li class="flex items-center">

                    <a href="mailto:{{$service->email}}"
                       class="btn btn-icon"> <i class="uil uil-mailbox text-2xl me-2 text-green-600"></i></a>
                </li>
            </ul>

            <ul class="md:pt-4 pt-6 flex justify-between gap-x-3 items-center list-none">
                <li>
                    <span class="text-slate-400">City</span>
                    <p class="text-lg font-medium">{{$service->city->title}}</p>
                </li>

                <li>
                    <span class="text-slate-400">Category</span>
                    <p class="text-lg font-medium text-1-line">{{$service->categories()->first()?->title}}</p>
                </li>
            </ul>
        </div>
    </div>
</div>
