@push('js')
    <script>
        const datatable_url = '/admin/setting?';
        const datatable_columns = [
            {data: 'id', name: 'id', width: "1%"},
            {data: 'key', name: 'key'},
            {data: 'value', name: 'value'},
            {data: 'help', name: 'help'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false,width: "1%",}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('setting.model')])=>route('admin.setting.index')]"
    :title="trans('general.page.index.title',['model'=>trans('setting.model')])">

    <x-admin.widget.datatable
        :rows="[ '#','پارامتر','مقدار','راهنما','عملیات']"
        :actions="[
    trans('general.page.index.create',['model'=>trans('setting.model')])=>route('admin.setting.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
