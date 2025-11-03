@push('js')
    <script>
        const datatable_url = '/admin/area?';
        const datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('area.model')])=>route('admin.area.index')]"
    :title="trans('general.page.index.title',['model'=>trans('area.model')])">

    <x-admin.widget.datatable
        :rows="['#','عملیات']"
        :actions="[
    trans('general.page.index.create',['model'=>trans('area.model')])=>route('admin.area.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
