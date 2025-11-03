@php use App\Enums\PermissionsEnum; @endphp
<form action="{{route('admin.estate.destroy',$row->id)}} " method="post">
    @method('delete')
    @csrf
    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
        <a role="button" class="btn btn-secondary btn-active-dark" href="{{route('admin.estate.edit',$row->id)}}"><i class="fa fa-pen"></i></a>
       @if(auth()->user()?->hasAnyPermission(PermissionsEnum::ESTATE_DELETE->value))
            <button type="submit" class="btn btn-secondary btn-active-danger sa-warning"><i class="fa fa-trash"></i></button>
       @endif
        <a role="button" class="btn btn-secondary btn-active-dark" href="{{route('estate.show',$row->slug)}}" target="_blank"><i class="fad fa-eye"></i></a>
    </div>
</form>