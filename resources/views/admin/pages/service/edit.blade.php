@php use App\Enums\BooleanEnum;use App\Helpers\Constants; @endphp
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('service.model')])=>route('admin.service.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('service.model')])">
    <x-admin.widget.form-card-transparent
{{--        :title="trans('general.page.edit.title',['model'=>trans('service.model'),'name'=>$service->title])"--}}
        :action="route('admin.service.update',$service->id)"
        :multipart="1"
        method="PATCH">

        <input hidden name="locale" value="{{app()->getLocale()}}"/>

        <x-admin.widget.card class="mb-5">
            <div class="col-lg-9 row">

                <x-admin.element.input
                    parent-class="col-md-6"
                    :label="trans('validation.attributes.title')"
                    name="title"
                    required="1"
                    :value="$service->title"
                />
                <x-admin.element.input
                    parent-class="col-md-6"
                    :label="trans('validation.attributes.key')"
                    name="key"
                    required="1"
                    :value="$service->key"
                />

                <x-admin.element.text-area
                    parent-class="col-lg-12"
                    :label="trans('validation.attributes.description')"
                    :required="1"
                    name="description"
                    :value="$service->description"/>
            </div>
            <div class="col-lg-3">
                <x-admin.element.dropify
                    :label="trans('validation.attributes.image')"
                    name="image"
                    required="0"
                    resolution="900*500"
                    default="{{$service->getFirstMediaUrl('image','200-200')}}"/>
            </div>
        </x-admin.widget.card>

        <x-admin.widget.card>
            <livewire:admin.pages.service.add-module :service="$service"/>
        </x-admin.widget.card>

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.service.index')"/>
        @endslot
    </x-admin.widget.form-card-transparent>
</x-admin.layout.master>