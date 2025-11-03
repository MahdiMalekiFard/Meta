<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('province.model')])=>route('admin.province.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('province.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('province.model'),'name'=>$province->name])"
        :action="route('admin.province.update',$province->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-md-6"
            :label="trans('validation.attributes.name')"
            name="title"
            required="1"
            :value="$province->title"
        />
        <x-admin.shared.countries-dropdown
            parent-class="col-md-6"
            :label="trans('validation.attributes.country')"
            name="country_uuid"
            required="1"
            :selected-rows="$selectedCountries"
        />


        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.province.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>