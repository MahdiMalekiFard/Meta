@push('js')
    <script>
        const datatable_url = '/admin/estate';
        const datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title', searchable: true},
            {data: 'categories_title', name: 'categories_title', searchable: true},
            {data: 'total_view', name: 'total_view'},
            {data: 'total_like', name: 'total_like'},
            {data: 'total_comment', name: 'total_comment'},
            {data: 'published', name: 'published'},
            {data: 'created_at', name: 'created_at'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
        datatable_columns.forEach(column => {
            column.searchable = column.searchable !== undefined ? column.searchable : false;
            column.orderable = column.orderable !== undefined ? column.orderable : false;
        });
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('estate.model')])=>route('admin.estate.index')]"
    :title="trans('general.page.index.title',['model'=>trans('estate.model')])">

    <x-admin.widget.datatable
        :rows="[
        trans('datatable.id'),
        trans('datatable.title'),
        trans('datatable.categories_title'),
        trans('datatable.view_count'),
        trans('datatable.like_count'),
        trans('datatable.comment_count'),
        trans('datatable.published'),
        trans('datatable.created_at'),
        trans('datatable.actions')
        ]"
        :filters="$filters"
        :actions="[
    trans('general.page.index.create',['model'=>trans('estate.model')])=>route('admin.estate.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
