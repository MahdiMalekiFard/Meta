<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('blog.model')])=>route('admin.blog.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('blog.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('blog.model'),'name'=>$blog->title])"
        :action="route('admin.blog.update',$blog->id)"
        :multipart="1"
        method="PATCH">

        <input hidden name="locale" value="{{app()->getLocale()}}"/>

        <x-admin.element.input
            parent-class="col-lg-6"
            :label="trans('validation.attributes.title')"
            name="title"
            required="1"
            :value="$blog->title"
        />

        <x-admin.shared.categories-dropdown
            parent-class="col-lg-6"
            :label="trans('validation.attributes.category')"
            name="categories_id[]"
            :multiple="1"
            :required="1"
            :selected-rows="$selectedCategories"
        />

        <x-admin.element.text-area
            parent-class="col-lg-12"
            :label="trans('validation.attributes.description')"
            name="description"
            required="1"
            :value="$blog->description"
        />

        <x-admin.element.tinymce
            parent-class="col-lg-12"
            :label="trans('validation.attributes.body')"
            :required="1"
            name="body"
            type="edit"
            :value="$blog->body"/>

        <x-admin.element.dropify
            :label="trans('validation.attributes.image')"
            name="image"
            required="0"
            resolution="900*500"
            default="{{$blog->getFirstMediaUrl('image','200-200')}}"/>

        <x-admin.shared.tags-dropdown
            parent-class="col-lg-6"
            :label="trans('validation.attributes.tags_id')"
            name="tags_id[]"
            :multiple="1"
            :required="0"
            :selected-rows="$selectedTags"
        />

        <x-admin.element.input
            parent-class="col-lg-6"
            :label="trans('validation.attributes.seo_title')"
            name="seo_title"
            :value="$blog->seo_title"
        />

        <x-admin.element.input
            parent-class="col-lg-6"
            :label="trans('validation.attributes.seo_description')"
            name="seo_description"
            :value="$blog->seo_description"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.blog.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>