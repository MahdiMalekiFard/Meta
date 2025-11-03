<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('module.model')])=>route('admin.module.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('module.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('module.model'),'name'=>$module->title])"
        :action="route('admin.module.update',$module->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.username')"
            name="name"
            required="1"
            :value="$module->name"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.module.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>