
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('ticket.model')])=>route('admin.ticket.index')]"
    :title="trans('general.page.create.page_title',['model'=>trans('ticket.model')])">

    <livewire:admin.pages.ticket.show :ticket="$ticket"/>

</x-admin.layout.master>
