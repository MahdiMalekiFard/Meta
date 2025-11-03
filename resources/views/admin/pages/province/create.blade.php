<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('province.model')])=>route('admin.province.index')]"
    :title="trans('general.page.create.page_title',['model'=>trans('province.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.create.title',['model'=>trans('province.model')])"
        :action="route('admin.province.store')">

        <x-admin.element.input
            parent-class="col-md-6"
            :label="trans('validation.attributes.title')"
            name="title"
            required="1"
        />
        <x-admin.shared.countries-dropdown
            parent-class="col-md-6"
            :label="trans('validation.attributes.country')"
            name="country_uuid"
            required="1"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.province.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
