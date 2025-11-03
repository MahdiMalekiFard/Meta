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
'data'=>[]
])

@once
    @push('js')
        <script>
            let uploadedDocumentAppMap = {};
            $('#kt_dropzonejs_example_1').dropzone({
                url: '{{ route('upload-image-dropzone') }}',
                maxFilesize: 2, // MB
                addRemoveLinks: true,
                acceptedFiles: 'image/*',
                thumbnailWidth: 200,
                thumbnailHeight: 200,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function (file, response) {
                    $('form').append('<input type="hidden" name="documentsDropzone[]" value="' + response.name + '">');
                    uploadedDocumentAppMap[file.name] = response.name;
                },
                removedfile: function (file) {
                    file.previewElement.remove();
                    let name = '';
                    if (typeof file.file_name !== 'undefined') {
                        name = file.file_name;
                    } else {
                        name = uploadedDocumentAppMap[file.name];
                    }
                    $('form').find('input[name="documentsDropzone[]"][value="' + name + '"]').remove();
                },
                @if($type=='edit')
                init: function () {
                    console.log({!! $data !!});
                    let files = {!! $data !!};
                    console.log(files.length);
                    for (var i in files) {
                        var file = files[i];
                        this.options.addedfile.call(this, file);
                        this.options.thumbnail.call(this, file, file.original_url);
                        file.previewElement.classList.add('dz-complete');
                        $('form').append('<input type="hidden" name="documentsDropzone[]" value="' + file.file_name + '">');
                    }
                }
                @endif

            });


        </script>

    @endpush
    @push('css')
        <style>
            .dropzone .dz-image-preview .dz-image img {
                background-size: contain;
                max-width: 200px; /* Set the maximum width for the image preview */
                max-height: 200px; /* Set the maximum height for the image preview */
            }

        </style>
    @endpush
@endonce

<x-admin.element.form-group
    :parentClass="$parentClass"
    :name="$name"
    :required="$required"
    :label="$label"
    :helperLabel="$helperLabel"
>
    <div class="dropzone" id="kt_dropzonejs_example_1">
        <div class="dz-message needsclick">
            <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
            <div class="ms-4">
                <h3 class="fs-5 fw-bolder text-gray-900 mb-1">فایل های خود را در این قسمت رها کنید</h3>
                <span class="fs-7 fw-bold text-gray-400">شما میتوانید تا 10 فایل در این قسمت بارگذاری کنید</span>
            </div>
        </div>
    </div>
</x-admin.element.form-group>
