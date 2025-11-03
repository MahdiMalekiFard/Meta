<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('faq.model')])=>route('admin.faq.index')]"
    :title="trans('general.page.create.page_title',['model'=>trans('faq.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.create.title',['model'=>trans('faq.model')])"
        :action="route('admin.faq.store')">

        <x-admin.element.input
            parent-class="col-md-12"
            :label="trans('validation.attributes.question')"
            name="title"
            required="1"
        />
        <x-admin.element.text-area
            parent-class="col-md-12"
            :label="trans('validation.attributes.answer')"
            name="description"
            required="1"
        />
        <x-admin.element.input
            parent-class="col-md-6"
            :label="trans('validation.attributes.part')"
            name="part"
            required="1"
        />
{{--        <x-admin.element.switch--}}
{{--            parent-class="col-md-6"--}}
{{--            :label="trans('validation.attributes.published')"--}}
{{--            name="published"--}}
{{--            required="0"--}}
{{--        />--}}



        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.faq.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
