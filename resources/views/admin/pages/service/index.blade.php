@push('js')
    <script>
        const datatable_url = '/admin/service?';
        const datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title', searchable: true},
            {data: 'key', name: 'key', searchable: true},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('service.model')])=>route('admin.service.index')]"
    :title="trans('general.page.index.title',['model'=>trans('service.model')])">

    <x-admin.widget.datatable
        :rows="[
        trans('datatable.id'),
        trans('datatable.title'),
        trans('validation.attributes.key'),
        trans('datatable.updated_at'),
        trans('datatable.actions')
        ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('service.model')])=>route('admin.service.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
