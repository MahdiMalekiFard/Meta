@push('js')
    <script>
        const datatable_url = '/admin/province?';
        const datatable_columns = [
            {data: 'id', name: 'id',orderable: true},
            {data: 'title', name: 'title', searchable: true},
            {data: 'country_title', name: 'country_title', searchable: true},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('province.model')])=>route('admin.province.index')]"
    :title="trans('general.page.index.title',['model'=>trans('province.model')])">

    <x-admin.widget.datatable
        :rows="[
        trans('datatable.id'),
        trans('datatable.title'),
        trans('datatable.country'),
        trans('datatable.actions'),
        ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('province.model')])=>route('admin.province.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
