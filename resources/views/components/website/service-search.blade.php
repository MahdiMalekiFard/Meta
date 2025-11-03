<div class="container relative">
    <div class="grid grid-cols-1 justify-center">
        <div class="relative -mt-32">
            <div class="grid grid-cols-1">
                <form action="{{route('service.index')}}">

                    <div id="StarterContent" class="p-6 bg-white dark:bg-slate-900 rounded-ss-none rounded-se-none md:rounded-se-xl rounded-xl shadow-md dark:shadow-gray-700">
                        <div class="" id="buy-home" role="tabpanel" aria-labelledby="buy-home-tab">
                            <div class="registration-form text-dark text-start">
                                <div class="grid lg:grid-cols-3 md:grid-cols-3 grid-cols-1 lg:gap-0 gap-6">
                                    <div>
                                        <label class="form-label font-medium text-slate-900 dark:text-white">Search : <span class="text-red-600">*</span></label>
                                        <div class="filter-search-form relative filter-border mt-2">
                                            <i class="uil uil-search icons"></i>
                                            <input name="keyword" value="{{request()->query('keyword')}}" type="text" id="job-keyword" class="form-input filter-input-box bg-gray-50 dark:bg-slate-800 border-0" placeholder="Search your keaywords">
                                        </div>
                                    </div>


                                    <div>
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

                                    <div>
                                        <label for="buy-min-price" class="form-label font-medium text-slate-900 dark:text-white">City :</label>
                                        <div class="filter-search-form relative filter-border mt-2">
                                            <i class="uil uil-usd-circle icons"></i>
                                            <select class="form-select" data-trigger name="city_id" id="choices-min-price-buy" aria-label="Default select example">
                                                <option value="">{{__('general.please_select_an_option')}}</option>
                                                @foreach($cities as $item)
                                                    <option value="{{$item->id}}" {{$item->id==request()->query('city_id')?'selected':''}}>{{$item->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="lg:mt-6">
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