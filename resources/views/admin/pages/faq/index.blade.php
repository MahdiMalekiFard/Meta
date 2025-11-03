@push('js')
    <script>
        const datatable_url = '/admin/faq?';
        const datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'part', name: 'part'},
            {data: 'published', name: 'published'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('faq.model')])=>route('admin.faq.index')]"
    :title="trans('general.page.index.title',['model'=>trans('faq.model')])">

    <x-admin.widget.datatable
        :rows="[
        trans('datatable.id'),
        trans('validation.attributes.question'),
        trans('validation.attributes.part'),
        trans('validation.attributes.published'),
        trans('datatable.actions'),
        ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('faq.model')])=>route('admin.faq.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
