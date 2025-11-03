<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('userRequest.model')])=>route('admin.user-request.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('userRequest.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('userRequest.model'),'name'=>$user->name])"
        :action="route('admin.user-request.update',$userRequest->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.username')"
            name="name"
            required="1"
            :value="$userRequest->name"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.user-request.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>