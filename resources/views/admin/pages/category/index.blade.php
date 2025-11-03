@push('js')
    <script>
        const datatable_url = '/admin/category/{{request()->route()->parameter('type')}}?';
        const datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title', searchable: true},
            {data: 'published', name: 'published'},
            {data: 'created_at', name: 'created_at'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('category.model')])=>route('admin.category.index',['type'=>request()->route()->parameter('type')])]"
    :title="trans('general.page.index.title',['model'=>trans('category.model')])">

    <x-admin.widget.datatable
        :rows="[
        trans('datatable.id'),
        trans('datatable.title'),
        trans('datatable.published'),
        trans('datatable.created_at'),
        trans('datatable.actions')
        ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('category.model')])=>route('admin.category.create',['type'=>request()->route()->parameter('type')]),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
