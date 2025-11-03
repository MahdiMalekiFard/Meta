<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('slider.model')])=>route('admin.slider.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('slider.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('slider.model'),'name'=>$user->name])"
        :action="route('admin.slider.update',$slider->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.username')"
            name="name"
            required="1"
            :value="$slider->name"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.slider.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>