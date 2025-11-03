<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('plan.model')])=>route('admin.plan.index')]"
    :title="trans('general.page.create.page_title',['model'=>trans('plan.model')])">
    <x-admin.widget.form-card-transparent
        {{--        :title="trans('general.page.create.title',['model'=>trans('plan.model')])"--}}
        :action="route('admin.plan.store')">

        <x-admin.widget.card class="mb-5">
            <x-admin.element.input
                parent-class="col-md-6"
                :label="trans('validation.attributes.title')"
                name="title"
                :required="1"
            />
            <x-admin.element.select
                parent-class="col-md-6"
                :label="trans('validation.attributes.service_id')"
                name="service_id"
                required="1"
            >
                @foreach($services as $service)
                    <option value="{{$service->id}}">{{$service->title}}</option>
                @endforeach
            </x-admin.element.select>

            <x-admin.element.text-area
                parent-class="col-lg-12"
                :label="trans('validation.attributes.description')"
                name="description"/>

        </x-admin.widget.card>

        <x-admin.widget.card>
            <livewire:admin.pages.plan.plan-pricing-table />
        </x-admin.widget.card>


        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.plan.index')"/>
        @endslot
    </x-admin.widget.form-card-transparent>
</x-admin.layout.master>
