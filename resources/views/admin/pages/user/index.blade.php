@push('js')
    <script>
        const datatable_url = '/admin/user?';
        const datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'created_at', name: 'created_at'},
            {data: 'status', name: 'status'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('user.model')])=>route('admin.user.index')]"
    :title="trans('general.page.index.title',['model'=>trans('user.model')])">

    <x-admin.widget.datatable
        :rows="['#','نام','ایمیل','ثبت نام','وضعیت','عملیات']"
        :actions="[
    trans('general.page.index.create',['model'=>trans('user.model')])=>route('admin.user.create'),
    ]"
        :export="1"
        :import="1"
        :filters="$filters">

    </x-admin.widget.datatable>


</x-admin.layout.master>
