@push('js')
    <script>
        const datatable_url = '/admin/plan';
        const datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title', searchable: true},
            {data: 'service', name: 'service', searchable: true},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('plan.model')])=>route('admin.plan.index')]"
    :title="trans('general.page.index.title',['model'=>trans('plan.model')])">

    <x-admin.widget.datatable
        :rows="[
        trans('datatable.id'),
        trans('datatable.title'),
        trans('validation.attributes.service_id'),
        trans('datatable.updated_at'),
        trans('datatable.actions')
        ]"

        :actions="[
    trans('general.page.index.create',['model'=>trans('plan.model')])=>route('admin.plan.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
