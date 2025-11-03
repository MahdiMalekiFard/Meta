@push('js')
    <script>
        const datatable_url = '/admin/city?';
        const datatable_columns = [
            {data: 'id', name: 'id', orderable: true},
            {data: 'title', name: 'title', searchable: true},
            {data: 'province_title', name: 'province_title', searchable: true},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('city.model')])=>route('admin.city.index')]"
    :title="trans('general.page.index.title',['model'=>trans('city.model')])">

    <x-admin.widget.datatable
        :rows="[
        trans('datatable.id'),
        trans('datatable.title'),
        trans('validation.attributes.province'),
        trans('datatable.actions'),
        ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('city.model')])=>route('admin.city.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
