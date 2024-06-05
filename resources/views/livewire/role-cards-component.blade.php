<div class="row">
    @foreach ($Role_with_user as $role_each)
<div class="col-xl-4 col-lg-6 col-md-6">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <span>{{$role_each->users_count}} Users</span>
                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                    @foreach ($role_each->users as $each_user)
                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                        title="{{$each_user->name}}" class="avatar avatar-sm pull-up ">
                        <img class="rounded-circle " src="{{asset('images/users')}}/{{$each_user->image}}"
                            onerror="this.onerror=null;this.src='{{ asset('images/default.png') }}';" />
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                <div class="role-heading">
                    <h4 class="fw-bolder">{{$role_each->name}}</h4>

                 
                </div>
                <button type="button" class="btn btn-relief-danger bx-flashing-hover"
                    wire:click="$emit('DeleteRole',{{$role_each->id}})"
                   >Delete</button>

            </div>
        </div>
    </div>
</div>
@endforeach
</div>
