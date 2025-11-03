@php use App\Helpers\Constants;@endphp
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('category.model')])=>route('admin.category.index',['type'=>$type])]"
    :title="trans('general.page.edit.page_title',['model'=>trans('category.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('category.model'),'name'=>$category->title])"
        :action="route('admin.category.update',['category'=>$category->id,'type'=>$type])"
        method="PATCH">
        <input type="hidden" name="type" value="{{$type}}">
        <input type="hidden" name="locale" value="{{app()->getLocale()}}">
        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.title')"
            name="title"
            required="1"
            :value="$category->title"
        />

        <x-admin.shared.categories-dropdown
            parent-class="col-lg-6"
            :label="__('datatable.parent_id')"
            name="parent_id"
            :selected-rows="$selectedCategories"
            :categoryType="\App\Enums\CategoryTypeEnum::BLOG->value"
        />


        <x-admin.element.select
            :parent-class="'col-lg-6'"
            :label="__('validation.attributes.published')"
            name="published"
            :value="$category->published"
            :type="\App\Enums\YesNoEnum::class"
        />
        <x-admin.element.tinymce
            :label="__('validation.attributes.body')"
            name="body"
            parent-class="col-lg-12"
            :value="$category->body"
            type="edit"
        />

        <x-admin.element.dropify
            parent-class="col-lg-6"
            :label="__('core.image')"
            :helper-label="Constants::RESOLUTION_720"
            name="image"
            default="{{$category->getFirstMediaUrl('image','480')}}"
        />

        <div class="col-lg-6">
            <x-admin.shared.seo-config
                colClass="col-lg-12"
                :item="$category"/>
        </div>

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.category.index',['type'=>$type])"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>