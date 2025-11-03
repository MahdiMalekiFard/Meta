@props([
'class' => '',
'type' => 'text',
'name'=>'',
'placeholder' => '',
'value' => '',
'label'=>'',
])
<div @class(['mb-4',$class])>
    <label class="font-semibold">{{$label}}:</label>
    <input type="{{$type}}"
           class="form-input mt-3"
           placeholder="{{$placeholder}}"
           name="{{$name}}"
           value="{{old($name,$value)}}"
            {{$attributes}}>
    @error($name)
    <small class="text-red-600 text-xs italic">{{$message}}</small>
    @enderror
</div>