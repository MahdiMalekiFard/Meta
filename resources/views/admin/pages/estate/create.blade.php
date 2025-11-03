@php use App\Enums\BooleanEnum;use App\Enums\EstatePurposeEnum;use App\Enums\NumberEnum;use App\Enums\PermissionsEnum;use App\Helpers\Constants; @endphp
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('estate.model')])=>route('admin.estate.index')]"
    :title="trans('general.page.create.page_title',['model'=>trans('estate.model')])">
    <x-admin.widget.form-card-transparent
        :action="route('admin.estate.store')">
        <input hidden name="locale" value="{{app()->getLocale()}}"/>

        <div class="row col-lg-8">
            <x-admin.widget.card class="" :title="__('core.content')">
                <x-admin.element.input
                    parent-class="col-lg-12"
                    :label="trans('validation.attributes.title')"
                    name="title"
                    required="1"
                />
                <x-admin.shared.categories-dropdown
                    parent-class="col-12"
                    :label="trans('validation.attributes.category')"
                    name="categories_id[]"
                    :multiple="1"
                    :required="1"
                />
                <x-admin.element.tinymce
                    :label="trans('validation.attributes.body')"
                    :required="1"
                    name="body"
                    type="edit"/>
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
                        <option value="{{$stateType->id}}">{{$stateType->title}}</option>
                    @endforeach
                </x-admin.element.select>

                @if(auth()->user()?->hasAnyPermission([PermissionsEnum::ESTATE_ALL->value,PermissionsEnum::ESTATE_UPDATE->value]))
                    <x-admin.element.select
                        parent-class="col-md-6"
                        :label="trans('validation.attributes.status')"
                        name="published"
                        required="1"
                        :type="BooleanEnum::class"
                    />
                @endif

                <livewire:admin.pages.estate.purpose-selector

                />
            </x-admin.widget.card>

            <x-admin.widget.card class="mt-5" :title="__('core.location')">
                <livewire:admin.shared.location-selector

                />
            </x-admin.widget.card>

            <x-admin.widget.card class="mt-5" :title="__('core.location_map')">
                <x-admin.element.input
                    parent-class="col-lg-6"
                    :label="__('validation.attributes.latitude')"
                    name="latitude"
                />
                <x-admin.element.input
                    parent-class="col-lg-6"
                    :label="__('validation.attributes.longitude')"
                    name="longitude"
                />
            </x-admin.widget.card>

            <x-admin.widget.card class="mt-5" :title="__('core.image_slides')">
                <x-admin.element.dropify
                    parent-class="col-lg-12"
                    :label="__('core.image')"
                    :helper-label="Constants::RESOLUTION_720"
                    name="image"
                    required="1"
                />
                <x-admin.element.dropzone
                    parent-class="col-lg-12"
                    :label="__('core.slides')"
                    :helper-label="Constants::RESOLUTION_720"
                    name="slides[]"
                />
            </x-admin.widget.card>
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
                />
                <x-admin.element.select
                    parent-class="col-md-6"
                    :label="trans('validation.attributes.rooms_count')"
                    name="rooms_count"
                    :type="NumberEnum::class"
                />
                <x-admin.element.select
                    parent-class="col-md-6"
                    :label="trans('validation.attributes.bathrooms_count')"
                    name="bathrooms_count"
                    :type="NumberEnum::class"
                />
                <x-admin.element.select
                    parent-class="col-md-6"
                    :label="trans('validation.attributes.bedrooms_count')"
                    name="bedrooms_count"
                    :type="NumberEnum::class"
                />
                <x-admin.element.select
                    parent-class="col-md-6"
                    :label="trans('validation.attributes.kitchens_count')"
                    name="kitchens_count"
                    :type="NumberEnum::class"
                />
                <x-admin.element.select
                    parent-class="col-md-6"
                    :label="trans('validation.attributes.drawing_rooms_count')"
                    name="drawing_rooms_count"
                    :type="NumberEnum::class"
                />
                <x-admin.element.select
                    parent-class="col-md-6"
                    :label="trans('validation.attributes.dining_rooms_count')"
                    name="dining_rooms_count"
                    :type="NumberEnum::class"
                />
                <x-admin.element.select
                    parent-class="col-md-6"
                    :label="trans('validation.attributes.laundry_rooms_count')"
                    name="laundry_rooms_count"
                    :type="NumberEnum::class"
                />
                <x-admin.element.select
                    parent-class="col-md-6"
                    :label="trans('validation.attributes.servant_quarters_count')"
                    name="servant_quarters_count"
                    :type="NumberEnum::class"
                />

                <x-admin.shared.tags-dropdown
                    parent-class="col-lg-12"
                    :label="trans('validation.attributes.tags_id')"
                    name="tags_id[]"
                    :multiple="1"
                    :required="0"
                />

            </x-admin.widget.card>
            <x-admin.widget.card class="ms-5 mt-5" :title="__('core.properties_features_amenities')">
                <x-admin.shared.property-selector/>
            </x-admin.widget.card>
        </div>

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.estate.index')"/>
        @endslot
    </x-admin.widget.form-card-transparent>
</x-admin.layout.master>
