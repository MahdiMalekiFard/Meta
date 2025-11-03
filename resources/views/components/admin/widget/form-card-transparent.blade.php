@props([
    'id'=>'form',
    'action'=>'',
    'method'=>'POST',
    'validate'=>0,
    'multipart'=>0,
    'title'=>null,
    'footer'=>null,
    'actions'=>null,
])

<x-admin.widget.form
    :action="$action"
    :method="$method"
    :validate="$validate"
    :multipart="$multipart"
    :id="$id"
    {{$attributes}}
>
    <x-admin.widget.card :title="$title" :actions="$actions" :footer="$footer" class="card-flush shadow-none border-0 bg-transparent" card_body_class="p-0 m-0">
        {{$slot}}
    </x-admin.widget.card>
</x-admin.widget.form>