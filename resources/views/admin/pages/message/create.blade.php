<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('message.model')])=>route('admin.message.index')]"
    :title="trans('general.page.create.page_title',['model'=>trans('message.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.create.title',['model'=>trans('message.model')])"
        :action="route('admin.message.store')">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.message')"
            name="name"
            required="1"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.message.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
