@push('js')
    <script>
        const datatable_url = '/admin/estate-type?';
        const datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('estateType.model')])=>route('admin.estate-type.index')]"
    :title="trans('general.page.index.title',['model'=>trans('estateType.model')])">

    <x-admin.widget.datatable
        :rows="['#','عملیات']"
        :actions="[
    trans('general.page.index.create',['model'=>trans('estateType.model')])=>route('admin.estate-type.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
