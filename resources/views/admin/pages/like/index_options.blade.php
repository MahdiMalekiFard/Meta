@php use App\Enums\RoleEnum; @endphp
<form action="{{route('admin.like.destroy',$row->id)}} " method="post">
    @method('delete')
    @csrf
    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
       @role(RoleEnum::ADMIN->value)
        <button type="submit" class="btn btn-secondary btn-active-danger sa-warning"><i class="fa fa-trash"></i></button>
       @endrole

        <a role="button" class="btn btn-secondary btn-active-dark" href="{{$row->likeable->path??'#'}}" target="_blank"><i class="fad fa-eye"></i></a>

    </div>
</form>