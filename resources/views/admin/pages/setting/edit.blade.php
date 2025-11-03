@push('js')

@endpush

<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('setting.model')])=>route('admin.setting.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('setting.model')])">
    <x-admin.widget.form-card
        :title="__($setting->help)"
        :action="route('admin.setting.update',$setting->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.key')"
            name="key"
            disabled
            :value="$setting->key"
        />

       @if(count($setting->extra_attributes->toArray())===0)
            <x-admin.element.input
                parent-class="col-lg-12"
                :label="trans('validation.attributes.value')"
                name="value"
                :value="$setting->value"
            />
       @endif


       @if(count($setting->extra_attributes->toArray())!==0)
            <div class="col-lg-12">
                <div class="form-group mb-3">
                    <label class="col-form-label">{{__('setting.extra_attributes')}}:</label>
                    @foreach($setting->extra_attributes->toArray() as $key=>$value)
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p type="text" name="extra_attributes[{{$loop->index}}][name]" class="form-control">{{$key}}</p>
                                <input type="text" name="extra_attributes[{{$loop->index}}][name]" class="form-control" hidden="hidden" value="{{$key}}"/>
                                <div class="d-md-none mb-2"></div>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="extra_attributes[{{$loop->index}}][value]" class="form-control" value="{{$value}}"/>
                                <div class="d-md-none mb-2"></div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
       @endif

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.setting.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>