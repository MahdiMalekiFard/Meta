<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('ticketMessage.model')])=>route('admin.ticket-message.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('ticketMessage.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('ticketMessage.model'),'name'=>$user->name])"
        :action="route('admin.ticket-message.update',$ticketMessage->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.username')"
            name="name"
            required="1"
            :value="$ticketMessage->name"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.ticket-message.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>