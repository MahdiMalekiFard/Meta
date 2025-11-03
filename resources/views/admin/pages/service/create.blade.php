@php use App\Enums\BooleanEnum;use App\Helpers\Constants; @endphp
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('service.model')])=>route('admin.service.index')]"
    :title="trans('general.page.create.page_title',['model'=>trans('service.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.create.title',['model'=>trans('service.model')])"
        :action="route('admin.service.store')">


        <input hidden name="locale" value="{{app()->getLocale()}}"/>

        <x-admin.element.input
            parent-class="col-md-6"
            :label="trans('validation.attributes.title')"
            name="title"
            required="1"
        />
        <x-admin.element.input
            parent-class="col-md-6"
            :label="trans('validation.attributes.key')"
            name="key"
            required="1"
        />


        <x-admin.element.tinymce
            parent-class="col-lg-12"
            :label="trans('validation.attributes.body')"
            :required="1"
            name="body"
            type="edit"
        />

        <x-admin.element.dropify
            :label="trans('validation.attributes.image')"
            name="image"
            required="0"
            resolution="900*500"/>


        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.service.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
