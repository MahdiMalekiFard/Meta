@push('js')
    <script>
        const datatable_url = '/admin/server';
        const datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'user_name', name: 'user_name'},
            {data: 'domain_name', name: 'domain_name', searchable: true},
            {data: 'services_name', name: 'services_name'},
            {data: 'expired_at', name: 'expired_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('server.model')])=>route('admin.server.index')]"
    :title="trans('general.page.index.title',['model'=>trans('server.model')])">

    <x-admin.widget.datatable
        :rows="[
        trans('datatable.id'),
        trans('datatable.user'),
        trans('validation.attributes.domain_name'),
        trans('validation.attributes.service_id'),
        trans('validation.attributes.expire_at'),
        trans('datatable.updated_at'),
        trans('datatable.actions')
        ]"
        :actions="[
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
