<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('orderItem.model')])=>route('admin.order-item.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('orderItem.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('orderItem.model'),'name'=>$orderItem->title])"
        :action="route('admin.order-item.update',$orderItem->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.username')"
            name="name"
            required="1"
            :value="$orderItem->name"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.order-item.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>