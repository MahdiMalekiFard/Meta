@push('js')
    <script>
        const datatable_url = '/admin/module';
        const datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('module.model')])=>route('admin.module.index')]"
    :title="trans('general.page.index.title',['model'=>trans('module.model')])">

    <x-admin.widget.datatable
        :rows="['#','عملیات']"
        :actions="[
    trans('general.page.index.create',['model'=>trans('module.model')])=>route('admin.module.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
