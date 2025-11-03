@props([
'parentClass' => '',
'id'=>null,
'name'=>'image',
'type'=>'file',
'label'=>'',
'helperLabel'=>null,
'required'=>0,
'default'=>'',
'size'=>'2M',
'resolution'=>'1280*720',
'extensions'=>'png jpg jpeg',
'messages_default'=>__('core.dropify.messages.default'),
'messages_replace'=>__('core.dropify.messages.replace'),
'messages_remove'=>__('core.dropify.messages.remove'),
'messages_error'=>__('core.dropify.messages.error'),
])

@once
    @push('css')
        <link href="/assets/plugins/custom/dropify/dropify.min.css" rel="stylesheet" type="text/css"/>
        <style>
            .dropify-wrapper .dropify-message p {
                font-size: 12px;
            }
        </style>
    @endpush
    @push('js')
        <script src="/assets/plugins/custom/dropify/dropify.min.js" type="text/javascript"></script>
        <script>
            jQuery(document).ready(function () {
                $('.dropify').dropify({
                    messages: {
                        default: '{{$messages_default}}',
                        replace: '{{$messages_replace}}',
                        remove: '{{$messages_remove}}',
                        error: '{{$messages_error}}'
                    }
                });
            });
        </script>
    @endpush
@endonce

<x-admin.element.form-group
    :class="$parentClass"
    :name="$name"
    :required="$required"
    :label="$label"
    :helperLabel="$helperLabel"
>
    <input type="{{$type}}"
           @if (isset($id))
               id="{{$id}}"
           @endif
           @if (isset($required) && $required==true)
               required data-validation-required-message="این فیلد الزامی میباشد"
           @endif
           data-default-file="{{$default}}"
           data-allowed-file-extensions="{{$extensions}}"
           data-max-file-size-preview="{{$size}}"
           class="form-control dropify"
           {{ $attributes }}
           name="{{$name}}">
</x-admin.element.form-group>
