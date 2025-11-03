<div class="container relative lg:mt-24 mt-16">
    <div class="grid md:grid-cols-12 grid-cols-1 items-center gap-[30px]">
        <div class="md:col-span-5">
            <div class="relative">
                <img src="/images/about.jpg" class="rounded-xl shadow-md" alt="">
                <div class="absolute bottom-2/4 translate-y-2/4 start-0 end-0 text-center">
                    {{--                            <a href="#!" data-type="youtube" data-id="yba7hPeTSjk"--}}
                    {{--                               class="lightbox h-20 w-20 rounded-full shadow-md dark:shadow-gyay-700 inline-flex items-center justify-center bg-white dark:bg-slate-900 text-green-600">--}}
                    {{--                                <i class="mdi mdi-play inline-flex items-center justify-center text-2xl"></i>--}}
                    {{--                            </a>--}}
                </div>
            </div>
        </div><!--end col-->

        <div class="md:col-span-7">
            <div class="lg:ms-4">
                <h4 class="mb-6 md:text-3xl text-2xl lg:leading-normal leading-normal font-semibold">{!! __('website/sections/about.title') !!}</h4>
                <p class="text-slate-400 max-w-xl">{!! __('website/sections/about.description') !!}</p>

                <div class="mt-4">
                    <a href="{{route('contact.index')}}" class="btn bg-green-600 hover:bg-green-700 text-white rounded-md mt-3">{{__('website/sections/about.btn_text')}}</a>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end grid-->
</div>