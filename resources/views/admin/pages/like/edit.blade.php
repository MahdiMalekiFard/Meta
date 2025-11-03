<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('like.model')])=>route('admin.like.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('like.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('like.model'),'name'=>$user->name])"
        :action="route('admin.like.update',$like->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.username')"
            name="name"
            required="1"
            :value="$like->name"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.like.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>