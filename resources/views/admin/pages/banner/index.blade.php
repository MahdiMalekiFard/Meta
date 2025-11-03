@push('js')
    <script>
        const datatable_url = '/admin/banner?';
        const datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title', searchable: true},
            {data: 'description', name: 'description', searchable: true},
            {data: 'link', name: 'link'},
            {data: 'button', name: 'button'},
            {data: 'gravity', name: 'gravity'},
            {data: 'click', name: 'click'},
            {data: 'limit', name: 'limit'},
            {data: 'published', name: 'published'},
            {data: 'expire_at', name: 'expire_at'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('banner.model')])=>route('admin.banner.index')]"
    :title="trans('general.page.index.title',['model'=>trans('banner.model')])">

    <x-admin.widget.datatable
        :rows="[
        trans('datatable.id'),
        trans('datatable.title'),
        trans('datatable.description'),
        trans('validation.attributes.button'),
        trans('validation.attributes.link'),
        trans('validation.attributes.gravity'),
        trans('validation.attributes.click'),
        trans('validation.attributes.limit'),
        trans('validation.attributes.published'),
        trans('validation.attributes.expire_at'),
        trans('datatable.actions'),
        ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('banner.model')])=>route('admin.banner.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
