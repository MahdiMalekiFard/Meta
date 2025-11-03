<div class="container relative lg:mt-24 mt-16">
    <div class="grid grid-cols-1 pb-8 text-center">
        <h3 class="mb-4 md:text-3xl md:leading-normal text-2xl leading-normal font-semibold">What Our Client Say ?</h3>

        <p class="text-slate-400 max-w-xl mx-auto">A great plateform to buy, sell and rent your properties without any agent or commisions.</p>
    </div><!--end grid-->

    <div class="flex justify-center relative mt-16">
        <div class="relative lg:w-1/3 md:w-1/2 w-full">
            <div class="absolute -top-20 md:-start-24 -start-0">
                <i class="mdi mdi-format-quote-open text-9xl opacity-5"></i>
            </div>

            <div class="absolute bottom-28 md:-end-24 -end-0">
                <i class="mdi mdi-format-quote-close text-9xl opacity-5"></i>
            </div>

            <div class="tiny-single-item">
               @foreach($opinions as $opinion)
                    <div class="tiny-slide">
                        <div class="text-center">
                            <p class="text-xl text-slate-400 italic"> " {{$opinion->body}} " </p>

                            <div class="text-center mt-5">
                               <x-website.stars-view :star="$opinion->star"/>

                                <img src="{{loadMedia($opinion,'image','thumb')}}" class="h-14 w-14 rounded-full shadow-md dark:shadow-gray-700 mx-auto" alt="">
                                <h6 class="mt-2 fw-semibold">{{$opinion->title}}</h6>
                                <span class="text-slate-400 text-sm">{{$opinion->company}}</span>
                            </div>
                        </div>
                    </div>
               @endforeach

            </div>
        </div>
    </div><!--end grid-->
</div>