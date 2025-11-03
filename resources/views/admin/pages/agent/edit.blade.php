<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('agent.model')])=>route('admin.agent.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('agent.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('agent.model'),'name'=>$user->name])"
        :action="route('admin.agent.update',$agent->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.username')"
            name="name"
            required="1"
            :value="$agent->name"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.agent.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>