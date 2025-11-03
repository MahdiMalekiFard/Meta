@push('js')
    <script>
        const datatable_url = '/admin/agent?';
        const datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('agent.model')])=>route('admin.agent.index')]"
    :title="trans('general.page.index.title',['model'=>trans('agent.model')])">

    <x-admin.widget.datatable
        :rows="['#','عملیات']"
        :actions="[
    trans('general.page.index.create',['model'=>trans('agent.model')])=>route('admin.agent.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
