@push('js')
    <script>
        const datatable_url = '/admin/like?';
        const datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'user_id', name: 'user_id'},
            {data: 'likeable_type', name: 'likeable_type'},
            {data: 'likeable_id', name: 'likeable_id'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('like.model')])=>route('admin.like.index')]"
    :title="trans('general.page.index.title',['model'=>trans('like.model')])">

    <x-admin.widget.datatable
        :rows="[
        trans('datatable.id'),
        trans('datatable.name'),
        trans('datatable.reference_type'),
        trans('datatable.title'),
        trans('datatable.actions'),
        ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('like.model')])=>route('admin.like.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
