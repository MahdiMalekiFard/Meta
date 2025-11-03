@php use App\Enums\BooleanEnum;use App\Enums\PermissionsEnum;  @endphp
@push('js')
    <script>
        const datatable_url = '/admin/comment?';
        const datatable_columns = [
            {data: 'id', name: 'id', searchable: false},
            {data: 'title', name: 'title', searchable: false, orderable: false},
            {data: 'description', name: 'description', searchable: true, orderable: false},
            {data: 'published', name: 'published', searchable: false, orderable: true},
            {data: 'user_name', name: 'user_id', searchable: false, orderable: false, visible: @js(auth()->user()?->hasAnyPermission([PermissionsEnum::COMMENT_ALL->value]))},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('comment.model')])=>route('admin.comment.index')]"
    :title="trans('general.page.index.title',['model'=>trans('comment.model')])">

    <x-admin.widget.datatable
        :rows="[
        trans('datatable.id'),
        trans('datatable.title'),
        trans('datatable.description'),
        trans('datatable.published'),
        trans('datatable.user'),
        trans('datatable.actions'),
        ]"
        :filters="$filters"
        :actions="auth()->user()?->hasAnyPermission([PermissionsEnum::COMMENT_ALL->value,PermissionsEnum::COMMENT_STORE->value])
        ?[trans('general.page.index.create',['model'=>trans('comment.model')])=>route('admin.comment.create')]
        :[]"
    >
    </x-admin.widget.datatable>


</x-admin.layout.master>
