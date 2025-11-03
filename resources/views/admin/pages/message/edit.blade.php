<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('message.model')])=>route('admin.message.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('message.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('message.model'),'name'=>$user->name])"
        :action="route('admin.message.update',$message->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.username')"
            name="name"
            required="1"
            :value="$message->name"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.message.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>