@push('js')
    <script>
        const datatable_url = '/admin/ticket?';
        const datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'subject', name: 'subject', searchable: true},
            {data: 'description', name: 'description', searchable: false,orderable: true},
            {data: 'department', name: 'department', searchable: false,orderable: true},
            {data: 'status', name: 'status', searchable: false,orderable: true},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('ticket.model')])=>route('admin.ticket.index')]"
    :title="trans('general.page.index.title',['model'=>trans('ticket.model')])">

    <x-admin.widget.datatable
        :rows="[
        trans('datatable.id'),
        trans('datatable.subject'),
        trans('datatable.description'),
        trans('datatable.department'),
        trans('datatable.status'),
        trans('datatable.actions'),
        ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('ticket.model')])=>route('admin.ticket.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
