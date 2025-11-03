@php use App\Enums\PermissionsEnum; @endphp
<form action="{{route('admin.ticket.destroy',$row->id)}} " method="post">
    @method('delete')
    @csrf
    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
        @if(auth()->user()?->hasAnyPermission(PermissionsEnum::TICKET_ALL->value))
            <a role="button" class="btn btn-secondary btn-active-dark" href="{{route('admin.ticket.edit',$row->id)}}"><i class="fa fa-pen"></i></a>
        @endif
        @if(auth()->user()?->hasAnyPermission(PermissionsEnum::TICKET_DELETE->value))
            <button type="submit" class="btn btn-secondary btn-active-danger sa-warning"><i class="fa fa-trash"></i></button>
        @endif
            <a role="button" class="btn btn-secondary btn-active-dark" href="{{route('admin.ticket.toggle',$row->id)}}"><i class="fad fa-slider"></i></a>
            <a role="button" class="btn btn-secondary btn-active-dark" href="{{route('admin.ticket.show',$row->id)}}" target="_blank"><i class="fad fa-eye"></i></a>
    </div>
</form>