<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('property.model')])=>route('admin.property.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('property.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('property.model'),'name'=>$user->name])"
        :action="route('admin.property.update',$property->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.username')"
            name="name"
            required="1"
            :value="$property->name"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.property.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>