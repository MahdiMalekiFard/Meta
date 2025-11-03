<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('report.model')])=>route('admin.report.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('report.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('report.model'),'name'=>$user->name])"
        :action="route('admin.report.update',$report->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.username')"
            name="name"
            required="1"
            :value="$report->name"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.report.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>