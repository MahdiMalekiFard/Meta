<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('estateType.model')])=>route('admin.estate-type.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('estateType.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('estateType.model'),'name'=>$user->name])"
        :action="route('admin.estate-type.update',$estateType->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.username')"
            name="name"
            required="1"
            :value="$estateType->name"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.estate-type.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>