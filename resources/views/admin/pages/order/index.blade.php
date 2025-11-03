@push('js')
    <script>
        const datatable_url = '/admin/order';
        const datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('order.model')])=>route('admin.order.index')]"
    :title="trans('general.page.index.title',['model'=>trans('order.model')])">

    <x-admin.widget.datatable
        :rows="['#','عملیات']"
        :actions="[
    trans('general.page.index.create',['model'=>trans('order.model')])=>route('admin.order.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
