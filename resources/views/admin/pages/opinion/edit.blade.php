@php use App\Helpers\Constants; @endphp
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('opinion.model')])=>route('admin.opinion.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('opinion.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('opinion.model'),'name'=>$opinion->title])"
        :action="route('admin.opinion.update',$opinion->id)"
        method="PATCH">

        <div class="col-md-10">
            <x-admin.element.input
                parent-class="col-12"
                :label="trans('validation.attributes.title')"
                name="title"
                required="1"
                :value="$opinion->title"
            />

            <x-admin.element.input
                parent-class="col-12"
                :label="trans('opinion.company')"
                name="company"
                required="1"
                :value="$opinion->company"
            />
        </div>
        <x-admin.element.dropify
            parent-class="col-md-2"
            :label="trans('validation.attributes.image')"
            name="image"
            required="0"
            :helper-label="Constants::RESOLUTION_480_SQUARE"
            :resolution="Constants::RESOLUTION_480_SQUARE"
            default="{{$opinion->getFirstMediaUrl('image','thumb')}}"/>

        <x-admin.element.select
            parent-class="col-md-6"
            :label="trans('validation.attributes.published')"
            name="published"
            :type="\App\Enums\YesNoEnum::class"
            required="1"
            :value="$opinion->published"
        />

        <x-admin.element.select
            parent-class="col-md-6"
            :label="trans('validation.attributes.star')"
            name="star"
            :type="\App\Enums\StarEnum::class"
            required="1"
            :value="$opinion->star"
        />

        <x-admin.element.text-area
            parent-class="col-md-12"
            :label="trans('validation.attributes.body')"
            name="body"
            required="1"
            :value="$opinion->body"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.opinion.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>