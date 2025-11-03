<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('reportReason.model')])=>route('admin.report-reason.index')]"
    :title="trans('general.page.create.page_title',['model'=>trans('reportReason.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.create.title',['model'=>trans('reportReason.model')])"
        :action="route('admin.report-reason.store')">

        <x-admin.element.input
            parent-class="col-md-6"
            :label="trans('validation.attributes.title')"
            name="title"
            required="1"
        />
        <x-admin.element.input
            parent-class="col-md-6"
            :label="trans('validation.attributes.published')"
            name="published"
            required="0"
        />
        <x-admin.element.text-area
            parent-class="col-md-6"
            :label="trans('validation.attributes.description')"
            name="description"
            required="1"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.report-reason.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
