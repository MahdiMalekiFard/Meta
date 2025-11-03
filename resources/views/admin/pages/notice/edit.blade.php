<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('notice.model')])=>route('admin.notice.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('notice.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('notice.model'),'name'=>$user->name])"
        :action="route('admin.notice.update',$notice->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.username')"
            name="name"
            required="1"
            :value="$notice->name"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.notice.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>