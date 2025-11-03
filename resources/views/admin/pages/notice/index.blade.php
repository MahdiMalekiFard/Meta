@push('js')
    <script>
        const datatable_url = '/admin/notice?';
        const datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('notice.model')])=>route('admin.notice.index')]"
    :title="trans('general.page.index.title',['model'=>trans('notice.model')])">

    <x-admin.widget.datatable
        :rows="['#','عملیات']"
        :actions="[
    trans('general.page.index.create',['model'=>trans('notice.model')])=>route('admin.notice.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
