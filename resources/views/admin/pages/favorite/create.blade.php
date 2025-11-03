<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('favorite.model')])=>route('admin.favorite.index')]"
    :title="trans('general.page.create.page_title',['model'=>trans('favorite.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.create.title',['model'=>trans('favorite.model')])"
        :action="route('admin.favorite.store')">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.username')"
            name="name"
            required="1"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.favorite.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
