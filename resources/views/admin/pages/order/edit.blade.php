<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('order.model')])=>route('admin.order.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('order.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('order.model'),'name'=>$order->title])"
        :action="route('admin.order.update',$order->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.username')"
            name="name"
            required="1"
            :value="$order->name"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.order.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>