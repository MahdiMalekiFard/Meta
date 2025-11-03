@props([
    'class'=>null,
    'label'=>null,
    'name'=>null,
    'required'=>0,
    'helper'=>null,
    'helperLabel'=>null
])
<div
        @class([
            'd-flex',
            'flex-column',
            'mb-8',
            'fv-row',
            'control-group',
            'has-validation'=>$errors->has($name),
            $class
    ])>
   <div class="controls">
       <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
        <span
        @class([
            'required'=>$required
        ])
        >
            {{$label}}
            @if($helperLabel)
                <small class="text-danger fw-bold">({{$helperLabel}})</small>
            @endif
        </span>

           @if($helper)
               <span class="ms-1" data-bs-toggle="tooltip" title="{{$helper}}">
                <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
            </span>
           @endif
       </label>
       {{$slot}}

       @error($name)
       <small class="form-control-feedback text-danger">{{$message}}</small>
       @enderror
   </div>
</div>