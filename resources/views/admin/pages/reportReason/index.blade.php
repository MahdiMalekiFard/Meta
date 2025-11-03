@push('js')
    <script>
        const datatable_url = '/admin/report-reason?';
        const datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title', searchable: true},
            {data: 'description', name: 'description', searchable: true},
            {data: 'published', name: 'published'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('reportReason.model')])=>route('admin.report-reason.index')]"
    :title="trans('general.page.index.title',['model'=>trans('reportReason.model')])">

    <x-admin.widget.datatable
        :rows="[
        trans('datatable.id'),
        trans('datatable.title'),
        trans('datatable.description'),
        trans('datatable.publish'),
        trans('datatable.actions'),
        ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('reportReason.model')])=>route('admin.report-reason.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
