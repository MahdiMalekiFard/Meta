@php use App\Enums\CategoryTypeEnum; @endphp
<form action="{{route('admin.category.destroy',['category'=>$row->id,'type'=>request()->route()->parameter('type')])}} " method="post">
    @method('delete')
    @csrf
    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
        <a role="button" class="btn btn-secondary btn-active-dark" href="{{route('admin.category.edit',['category'=>$row->id,'type'=>request()->route()->parameter('type')])}}"><i class="fa fa-pen"></i></a>
        <button type="submit" class="btn btn-secondary btn-active-danger sa-warning"><i class="fa fa-trash"></i></button>
    </div>
</form>