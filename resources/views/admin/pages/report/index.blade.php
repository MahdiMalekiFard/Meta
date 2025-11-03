@push('js')
    <script>
        const datatable_url = '/admin/report?';
        const datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'user_id', name: 'user_id'},
            {data: 'report_reason_id', name: 'report_reason_id'},
            {data: 'reportable_id', name: 'reportable_id'},
            {data: 'reportable_type', name: 'reportable_type'},
            {data: 'user_id', name: 'user_id'},
            {data: 'message', name: 'message'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('report.model')])=>route('admin.report.index')]"
    :title="trans('general.page.index.title',['model'=>trans('report.model')])">

    <x-admin.widget.datatable
        :rows="[
        trans('datatable.id'),
        trans('datatable.name'),
        trans('datatable.reference_id'),
        trans('datatable.reference_type'),
        trans('datatable.title'),
        trans('validation.attributes.message'),
        trans('datatable.actions'),
        ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('report.model')])=>route('admin.report.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
