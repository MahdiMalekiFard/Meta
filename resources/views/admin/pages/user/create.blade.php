<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('user.model')])=>route('admin.user.index')]"
    :title="trans('general.page.create.page_title',['model'=>trans('user.model')])">
    <x-admin.widget.form-card-transparent
{{--        :title="trans('general.page.create.title',['model'=>trans('user.model')])"--}}
        :action="route('admin.user.store')">

        <div class="row col-lg-4">
            <x-admin.widget.card title="اطلاعات اصلی">
                <x-admin.element.input
                    parent-class="col-lg-12"
                    :label="trans('validation.attributes.username')"
                    name="name"
                    required="1"
                />
                <x-admin.element.input
                    parent-class="col-lg-12"
                    :label="trans('validation.attributes.mobile')"
                    name="mobile"
                    required="1"
                />
                <x-admin.element.input
                    parent-class="col-lg-12"
                    :label="trans('validation.attributes.email')"
                    name="email"
                    required="1"
                />
            </x-admin.widget.card>
        </div>
        <div class="row col-lg-8">
           <x-admin.widget.card class="ms-5">
               <x-admin.element.input
                   parent-class="col-lg-12"
                   :label="trans('validation.attributes.password')"
                   name="password"
                   required="1"
               />
               <x-admin.element.input
                   parent-class="col-lg-12"
                   :label="trans('validation.attributes.password_confirmation')"
                   name="password_confirmation"
                   required="1"
               />
           </x-admin.widget.card>
        </div>




        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.user.index')"/>
        @endslot
    </x-admin.widget.form-card-transparent>
</x-admin.layout.master>
