<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('reportReason.model')])=>route('admin.report-reason.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('reportReason.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('reportReason.model'),'name'=>$reportReason->title])"
        :action="route('admin.report-reason.update',$reportReason->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-md-6"
            :label="trans('validation.attributes.title')"
            name="title"
            required="1"
            :value="$reportReason->title"
        />
        <x-admin.element.input
            parent-class="col-md-6"
            :label="trans('validation.attributes.published')"
            name="published"
            required="0"
            :value="$reportReason->published"
        />
        <x-admin.element.text-area
            parent-class="col-md-6"
            :label="trans('validation.attributes.description')"
            name="description"
            required="1"
            :value="$reportReason->description"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.report-reason.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>