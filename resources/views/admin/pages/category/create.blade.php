@php use App\Helpers\Constants;@endphp
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('category.model')])=>route('admin.category.index',['type'=>$type])]"
    :title="trans('general.page.create.page_title',['model'=>trans('category.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.create.title',['model'=>trans('category.model')])"
        :action="route('admin.category.store',['type'=>$type])">
        <input type="hidden" name="type" value="{{$type}}">
        <input type="hidden" name="locale" value="{{app()->getLocale()}}">
        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.title')"
            name="title"
            required="1"
        />

        <x-admin.shared.categories-dropdown
            parent-class="col-lg-6"
            :label="__('datatable.parent_id')"
            name="parent_id"
            :categoryType="\App\Enums\CategoryTypeEnum::BLOG->value"
        />

        <x-admin.element.select
            :parent-class="'col-lg-6'"
            :label="__('validation.attributes.published')"
            name="published"
            :type="\App\Enums\YesNoEnum::class"
        />

        <x-admin.element.tinymce
            :label="__('validation.attributes.body')"
            name="body"
            parent-class="col-lg-12"
        />

        <x-admin.element.dropify
            parent-class="col-lg-6"
            :label="__('core.image')"
            :helper-label="Constants::RESOLUTION_720"
            name="image"
        />

        <div class="col-lg-6">
            <x-admin.shared.seo-config
                colClass="col-lg-12"
                :item="null"/>
        </div>

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.category.index',['type'=>$type])"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
