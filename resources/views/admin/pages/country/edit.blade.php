<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('country.model')])=>route('admin.country.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('country.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('country.model'),'name'=>$country->title])"
        :action="route('admin.country.update',$country->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-md-6"
            :label="trans('validation.attributes.title')"
            name="title"
            required="1"
        />
        <x-admin.element.input
            parent-class="col-md-6"
            :label="trans('validation.attributes.code')"
            name="code"
            required="0"
        />
        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.country.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>