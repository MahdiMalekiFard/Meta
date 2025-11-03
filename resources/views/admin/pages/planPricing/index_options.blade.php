<form action="{{route('admin.plan-pricing.destroy',$row->id)}} " method="post">
    @method('delete')
    @csrf
    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
        <a role="button" class="btn btn-secondary btn-active-dark" href="{{route('admin.plan-pricing.edit',$row->id)}}"><i class="fa fa-pen"></i></a>
        <button type="submit" class="btn btn-secondary btn-active-danger sa-warning"><i class="fa fa-trash"></i></button>
    </div>
</form>