@push('js')
    <script>
        const datatable_url = '/admin/opinion?';
        const datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title', searchable: true},
            {data: 'company', name: 'company', searchable: true},
            {data: 'published', name: 'published'},
            {data: 'created_at', name: 'created_at'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('opinion.model')])=>route('admin.opinion.index')]"
    :title="trans('general.page.index.title',['model'=>trans('opinion.model')])">

    <x-admin.widget.datatable
        :rows="[
        trans('datatable.id'),
        trans('datatable.title'),
        trans('opinion.company'),
        trans('datatable.published'),
        trans('datatable.created_at'),
        trans('datatable.actions'),
        ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('opinion.model')])=>route('admin.opinion.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
