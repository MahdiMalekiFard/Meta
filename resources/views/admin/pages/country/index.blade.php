@push('js')
    <script>
        const datatable_url = '/admin/country?';
        const datatable_columns = [
            {data: 'id', name: 'id', orderable: true},
            {data: 'title', name: 'title', searchable: true},
            {data: 'code', name: 'code'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('country.model')])=>route('admin.country.index')]"
    :title="trans('general.page.index.title',['model'=>trans('country.model')])">

    <x-admin.widget.datatable
        :rows="[
        trans('datatable.id'),
        trans('datatable.title'),
        trans('datatable.code'),
        trans('datatable.actions'),
        ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('country.model')])=>route('admin.country.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
