<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('server.model')])=>route('admin.server.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('server.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('server.model'),'name'=>$server->title])"
        :action="route('admin.server.update',$server->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.username')"
            name="name"
            required="1"
            :value="$server->name"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.server.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>