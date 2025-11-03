<div class="container relative">
    <div class="grid grid-cols-1 justify-center">
        <div class="relative -mt-24">
            <div class="grid grid-cols-1" x-data="{type:{{request()->query('purpose',1)}}}">
                <form action="{{route('estate.index')}}">
                    <ul class="inline-block sm:w-fit w-full flex-wrap justify-center text-center p-4 bg-white dark:bg-slate-900 rounded-t-xl border-b dark:border-gray-800" id="myTab" data-tabs-toggle="#StarterContent" role="tablist">

                        <li role="presentation" class="inline-block">
                            <button class="px-6 py-2 text-base font-medium rounded-md w-full transition-all duration-500 ease-in-out"
                                    x-bind:class="type===1?'text-white bg-green-600':''"
                                    x-on:click="type=1"
                                    id="rent-home-tab" data-tabs-target="#rent-home" type="button" role="tab" aria-controls="rent-home" x-bind:aria-selected="type===1">Rent
                            </button>
                        </li>

                        <li role="presentation" class="inline-block">
                            <button class="px-6 py-2 text-base font-medium rounded-md w-full transition-all duration-500 ease-in-out"
                                    x-bind:class="type===2?'text-white bg-green-600':''"
                                    x-on:click="type=2"
                                    id="buy-home-tab" data-tabs-target="#buy-home" type="button" role="tab" aria-controls="buy-home" x-bind:aria-selected="type===2">Buy
                            </button>
                        </li>


                    </ul>

                    <div id="StarterContent" class="p-6 bg-white dark:bg-slate-900 rounded-ss-none rounded-se-none md:rounded-se-xl rounded-xl shadow-md dark:shadow-gray-700">
                        <div class="" id="buy-home" role="tabpanel" aria-labelledby="buy-home-tab">
                            <input class="hidden" name="purpose" x-bind:value="type">
                            <div class="registration-form text-dark text-start">
                                <div class="grid lg:grid-cols-12 md:grid-cols-12 grid-cols-12 lg:gap-0 gap-0">

                                    <div class="lg:col-span-6 md:col-span-6 col-span-12 mt-5">
                                        <label class="form-label font-medium text-slate-900 dark:text-white">Search : <span class="text-red-600">*</span></label>
                                        <div class="filter-search-form relative filter-border mt-2">
                                            <i class="uil uil-search icons"></i>
                                            <input name="keyword" value="{{request()->query('keyword')}}" type="text" id="job-keyword" class="form-input filter-input-box bg-gray-50 dark:bg-slate-800 border-0" placeholder="Search your keaywords">
                                        </div>
                                    </div>

                                    <div class="lg:col-span-6 md:col-span-6 col-span-12 mt-5">
                                        <label for="buy-properties" class="form-label font-medium text-slate-900 dark:text-white">Select Categories:</label>
                                        <div class="filter-search-form relative filter-border mt-2">
                                            <i class="uil uil-estate icons"></i>
                                            <select class="form-select z-2" data-trigger name="category_id" id="choices-catagory-buy" aria-label="Default select example">
                                                <option value="">{{__('general.please_select_an_option')}}</option>
                                                @foreach($categories as $item)
                                                    <option value="{{$item->id}}" {{$item->id==request()->query('category_id')?'selected':''}}>{{$item->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="lg:col-span-4 md:col-span-6 col-span-6 mt-5">
                                        <label for="buy-min-price" class="form-label font-medium text-slate-900 dark:text-white">Min Price :</label>
                                        <div class="filter-search-form relative filter-border mt-2">
                                            <i class="uil uil-usd-circle icons"></i>
                                            <select class="form-select" data-trigger name="min_price" id="choices-min-price-buy" aria-label="Default select example">
                                                <option value="">Min Price</option>
                                                @foreach($minPriceList as $item)
                                                    <option value="{{$item}}" {{$item==request()->query('min_price')?'selected':''}}>{{number_format(round($item))}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="lg:col-span-4 md:col-span-6 col-span-6 mt-5">
                                        <label for="buy-max-price" class="form-label font-medium text-slate-900 dark:text-white">Max Price :</label>
                                        <div class="filter-search-form relative filter-border mt-2">
                                            <i class="uil uil-usd-circle icons"></i>
                                            <select class="form-select" data-trigger name="max_price" id="choices-max-price-buy" aria-label="Default select example">
                                                <option value="">Max Price</option>
                                                @foreach($maxPriceList as $item)
                                                    <option value="{{$item}}" {{$item==request()->query('max_price')?'selected':''}}>{{number_format(round($item))}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="lg:col-span-4 md:col-span-12 col-span-12 mt-5">
                                        <label for="choices-city-id" class="form-label font-medium text-slate-900 dark:text-white">City :</label>
                                        <div class="filter-search-form relative filter-border mt-2">
                                            <i class="uil uil-usd-circle icons"></i>
                                            <select class="form-select" data-trigger name="city_id" id="choices-city-id" aria-label="Default select example">
                                                <option value="">{{__('general.please_select_an_option')}}</option>
                                                @foreach($cities as $item)
                                                    <option value="{{$item->id}}" {{$item->id==request()->query('city_id')?'selected':''}}>{{$item->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-span-12 mt-6">
                                        <button type="submit" id="search-buy" class="btn bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white searchbtn submit-btn w-full !h-12 rounded">Search</button>
                                    </div>

                                </div><!--end grid-->
                            </div><!--end container-->

                        </div>
                    </div>
                </form>
            </div><!--end grid-->
        </div>
    </div><!--end grid-->
</div>