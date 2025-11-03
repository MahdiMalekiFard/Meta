@push('js')
    <script>
        const datatable_url = '/admin/plan-pricing';
        const datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('planPricing.model')])=>route('admin.plan-pricing.index')]"
    :title="trans('general.page.index.title',['model'=>trans('planPricing.model')])">

    <x-admin.widget.datatable
        :rows="['#','عملیات']"
        :actions="[
    trans('general.page.index.create',['model'=>trans('planPricing.model')])=>route('admin.plan-pricing.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
