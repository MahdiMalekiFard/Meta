@php use App\Enums\TicketDepartmentEnum;use App\Enums\TicketPriorityEnum;use App\Enums\TicketStatusEnum;use App\Enums\TicketActionTypeEnum@endphp
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('ticket.model')])=>route('admin.ticket.index')]"
    :title="trans('general.page.create.page_title',['model'=>trans('ticket.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.create.title',['model'=>trans('ticket.model')])"
        :action="route('admin.ticket.store')">


        <x-admin.element.input
            parent-class="col-md-6"
            :label="trans('validation.attributes.subject')"
            name="subject"
            required="1"
        />
        <x-admin.element.select
            parent-class="col-md-6"
            :label="trans('validation.attributes.department')"
            name="department"
            required="1"
            :options="TicketDepartmentEnum::selectData()"
        />
        <x-admin.element.text-area
            parent-class="col-lg-12"
            :label="trans('validation.attributes.description')"
            name="description"
            required="1"
        />

        <x-admin.element.select
            parent-class="col-md-6"
            :label="trans('validation.attributes.priority')"
            name="priority"
            required="1"
            :options="TicketPriorityEnum::selectData()"
        />

        <x-admin.element.select
            parent-class="col-md-6"
            :label="trans('validation.attributes.action_type')"
            name="action_type"
            required="1"
            :options="TicketActionTypeEnum::selectData()"
        />


        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.ticket.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
