<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('subscription.model')])=>route('admin.subscription.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('subscription.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('subscription.model'),'name'=>$user->name])"
        :action="route('admin.subscription.update',$subscription->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.username')"
            name="name"
            required="1"
            :value="$subscription->name"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.subscription.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>