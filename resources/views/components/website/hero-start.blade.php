<section class="swiper-slider-hero swiper relative block h-screen" style="z-index: 0">
    <div class="swiper-container absolute end-0 top-0 w-full h-full">
        <div class="swiper-wrapper">
            @foreach($banners as $banner)
                <div class="swiper-slide flex items-center overflow-hidden">
                    <div class="slide-inner absolute end-0 top-0 w-full h-full slide-bg-image flex items-center bg-center;" data-background="{{loadMedia($banner,'image','1080')}}">
                        <div class="absolute inset-0 bg-black/70"></div>
                        <div class="container relative">
                            <div class="grid grid-cols-1">
                                <div class="text-center">
                                    <h1 class="font-bold text-white lg:leading-normal leading-normal text-4xl lg:text-5xl mb-6">{{$banner->title}}</h1>
                                    <p class="text-white/70 text-xl max-w-xl mx-auto">{{$banner->description}}</p>

                                    <div class="mt-6">
                                        <a target="_blank" href="{{route('banner-clicked',$banner->id)}}" class="btn bg-green-600 hover:bg-green-700 text-white rounded-md">See More</a>
                                    </div>
                                </div>
                            </div><!--end grid-->
                        </div><!--end container-->
                    </div><!-- end slide-inner -->
                </div>
            @endforeach
        </div>
        <!-- end swiper-wrapper -->

        <!-- swipper controls -->
        <!-- <div class="swiper-pagination"></div> -->
        <div class="swiper-button-next bg-transparent w-[35px] h-[35px] leading-[35px] -mt-[30px] bg-none border border-solid border-white/50 text-white hover:bg-green-600 hover:border-green-600 rounded-full text-center"></div>
        <div class="swiper-button-prev bg-transparent w-[35px] h-[35px] leading-[35px] -mt-[30px] bg-none border border-solid border-white/50 text-white hover:bg-green-600 hover:border-green-600 rounded-full text-center"></div>
    </div><!--end container-->
</section>