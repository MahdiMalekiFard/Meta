@php use App\Enums\BooleanEnum;use App\Enums\EstatePurposeEnum;use App\Enums\NumberEnum;use App\Helpers\Constants;use App\Enums\PermissionsEnum; @endphp
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('estate.model')])=>route('admin.estate.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('estate.model')])">
    <x-admin.widget.form-card-transparent
        :action="route('admin.estate.update',$estate->id)"
        method="PATCH">

        <input hidden name="locale" value="{{app()->getLocale()}}"/>

        <div class="row col-lg-8">
            <x-admin.widget.card class="" :title="__('core.content')">
                <x-admin.element.input
                    parent-class="col-lg-12"
                    :label="trans('validation.attributes.title')"
                    name="title"
                    required="1"
                    :value="$estate->title"
                />
                <x-admin.shared.categories-dropdown
                    parent-class="col-12"
                    :label="trans('validation.attributes.category')"
                    name="categories_id[]"
                    :multiple="1"
                    :required="1"
                    :selected-rows="$selectedCategories"
                />
                <x-admin.element.tinymce
                    :label="trans('validation.attributes.body')"
                    :required="1"
                    name="body"
                    type="edit"
                    :value="$estate->body"/>
            </x-admin.widget.card>
            <x-admin.widget.card class=" mt-5" :title="__('estate.property_config')">
                <x-admin.element.select
                    parent-class="col-md-6"
                    :label="trans('validation.attributes.property_type_id')"
                    name="state_type"
                    required="1"
                >
                    <option value="">{{__('general.please_select_an_option')}}</option>
                    @foreach($stateTypes as $stateType)
                        <option value="{{$stateType->id}}" {{$stateType->id===$estate->estate_type_id?'selected':''}}>{{$stateType->title}}</option>
                    @endforeach
                </x-admin.element.select>

                @if(auth()->user()?->hasAnyPermission([PermissionsEnum::ESTATE_ALL->value,PermissionsEnum::ESTATE_UPDATE->value]))
                    <x-admin.element.select
                        parent-class="col-md-6"
                        :label="trans('validation.attributes.status')"
                        name="published"
                        required="1"
                        :value="$estate->published->value"
                        :type="BooleanEnum::class"
                    />
                @endif
                <livewire:admin.pages.estate.purpose-selector
                    :purpose="$estate->purpose->value"
                    :price="$estate->price"
                    :rent="$estate->rent"
                    :mortgage="$estate->mortgage"
                />
            </x-admin.widget.card>

            <x-admin.widget.card class=" mt-5" :title="__('core.location')">
                <livewire:admin.shared.location-selector
                    :country-id="$estate->city->province->country_id"
                    :province-id="$estate->city->province_id"
                    :city-id="$estate->city_id"
                    :area-id="$estate->area_id"
                    :locality-id="$estate->locality_id"
                />
            </x-admin.widget.card>

            <x-admin.widget.card class="mt-5" :title="__('core.location_map')">
                <x-admin.element.input
                    parent-class="col-lg-6"
                    :label="__('validation.attributes.latitude')"
                    name="latitude"
                    :value="$estate->latitude"
                />
                <x-admin.element.input
                    parent-class="col-lg-6"
                    :label="__('validation.attributes.longitude')"
                    name="longitude"
                    :value="$estate->longitude"
                />
            </x-admin.widget.card>

            <x-admin.widget.card class="mt-5" :title="__('core.image_slides')">
                <x-admin.element.dropify
                    parent-class="col-lg-12"
                    :label="__('core.image')"
                    :helper-label="Constants::RESOLUTION_720"
                    name="image"
                    default="{{$estate->getFirstMediaUrl('image','480')}}"
                />
                <x-admin.element.dropzone
                    parent-class="col-lg-12"
                    :label="__('core.slides')"
                    :helper-label="Constants::RESOLUTION_720"
                    name="slides[]"
                    type="edit"
                    :data="json_encode($estate->getMedia('slides'))"
                />
            </x-admin.widget.card>

            @if(auth()->user()?->hasAnyPermission([PermissionsEnum::ESTATE_ALL->value,PermissionsEnum::ESTATE_UPDATE->value]))
                <x-admin.widget.card class="mt-5" :title="__('core.seo_configs')">
                    <x-admin.shared.seo-config
                        :item="$estate"
                        colClass="col-lg-12"
                    />
                </x-admin.widget.card>
            @endif
        </div>

        <div class="row col-lg-4">
            <x-admin.widget.card class="ms-5" :title="__('estate.property_details')">
                <x-admin.element.input
                    parent-class="col-md-6"
                    :label="trans('validation.attributes.area_meter')"
                    :helper="trans('estate.helpers.m2')"
                    helper-label="in m2"
                    name="area_meter"
                    required="1"
                    type="number"
                    :value="$estate->area_meter"
                />
                <x-admin.element.select
                    parent-class="col-md-6"
                    :label="trans('validation.attributes.rooms_count')"
                    name="rooms_count"
                    :type="NumberEnum::class"
                    :value="$estate->rooms_count"
                />
                <x-admin.element.select
                    parent-class="col-md-6"
                    :label="trans('validation.attributes.bathrooms_count')"
                    name="bathrooms_count"
                    :type="NumberEnum::class"
                    :value="$estate->bathrooms_count"
                />
                <x-admin.element.select
                    parent-class="col-md-6"
                    :label="trans('validation.attributes.bedrooms_count')"
                    name="bedrooms_count"
                    :type="NumberEnum::class"
                    :value="$estate->bedrooms_count"
                />
                <x-admin.element.select
                    parent-class="col-md-6"
                    :label="trans('validation.attributes.kitchens_count')"
                    name="kitchens_count"
                    :type="NumberEnum::class"
                    :value="$estate->kitchens_count"
                />
                <x-admin.element.select
                    parent-class="col-md-6"
                    :label="trans('validation.attributes.drawing_rooms_count')"
                    name="drawing_rooms_count"
                    :type="NumberEnum::class"
                    :value="$estate->drawing_rooms_count"
                />
                <x-admin.element.select
                    parent-class="col-md-6"
                    :label="trans('validation.attributes.dining_rooms_count')"
                    name="dining_rooms_count"
                    :type="NumberEnum::class"
                    :value="$estate->dining_rooms_count"
                />
                <x-admin.element.select
                    parent-class="col-md-6"
                    :label="trans('validation.attributes.laundry_rooms_count')"
                    name="laundry_rooms_count"
                    :type="NumberEnum::class"
                    :value="$estate->laundry_rooms_count"
                />
                <x-admin.element.select
                    parent-class="col-md-6"
                    :label="trans('validation.attributes.servant_quarters_count')"
                    name="servant_quarters_count"
                    :type="NumberEnum::class"
                    :value="$estate->servant_quarters_count"
                />

                <x-admin.shared.tags-dropdown
                    parent-class="col-lg-12"
                    :label="trans('validation.attributes.tags_id')"
                    name="tags_id[]"
                    :multiple="1"
                    :required="0"
                    :selected-rows="$selectedTags"
                />

            </x-admin.widget.card>
            <x-admin.widget.card class="ms-5 mt-5" :title="__('core.properties_features_amenities')">
                <x-admin.shared.property-selector :checked-ids="$estate->properties->pluck('pivot.property_id')->toArray()"/>
            </x-admin.widget.card>
        </div>


        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.estate.index')"/>
        @endslot
    </x-admin.widget.form-card-transparent>
</x-admin.layout.master>