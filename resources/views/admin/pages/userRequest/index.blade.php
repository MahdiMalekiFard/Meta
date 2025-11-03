@push('js')
    <script>
        const datatable_url = '/admin/user-request?';
        const datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('userRequest.model')])=>route('admin.user-request.index')]"
    :title="trans('general.page.index.title',['model'=>trans('userRequest.model')])">

    <x-admin.widget.datatable
        :rows="['#','عملیات']"
        :actions="[
    trans('general.page.index.create',['model'=>trans('userRequest.model')])=>route('admin.user-request.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
