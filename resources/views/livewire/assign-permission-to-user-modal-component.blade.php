<div>
    <!-- Add Role Modal -->
    <div class="modal fade addUserPerModal" id="addUserPerModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-5 pb-5">
                    <div class="text-center mb-4">
                        <h1 class="role-title">Assign Permission To Users</h1>
                        <p>Make Your User PowerFul by assigning the Direct Permissions</p>
                    </div>
                    <!-- Add role form -->
                    <form method="POST" wire:submit.prevent="submit" class="userperForm">
                        @csrf
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Assign Permission to Users</h3>
                                <div class="block-options">
                                    <button type="submit" class="btn btn-sm btn-primary">Add</button>
                                    <button type="button" data-bs-dismiss="modal"
                                        class="btn btn-sm btn-primary">Cancel</button>

                                </div>
                            </div>
                            <div class="block-content">
                                <div class="row justify-content-center py-sm-3 py-md-5">

                                    <div class="form-group col-md-6">
                                        <label for="Certificate">Users</label>
                                        <select class="select form-select @error('model.UserName') is-invalid @enderror"
                                            id="select2-nested" wire:model.lazy="model.UserName">
                                            @foreach ($users as $user_each)
                                            <option value=""  selected>Select User</option>
                                            <option value="{{ $user_each->id }}">{{ $user_each->name
                                                }}:{{$user_each->email}}</option>
                                            @endforeach
                                        </select>
                                        @error('model.UserName')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="Certificate">Permission</label>
                                        <select
                                            class="select form-select @error('model.PermissionName') is-invalid @enderror"
                                            id="select2-basic" wire:model.lazy="model.PermissionName">
                                            <option value=""  selected>Select Permisison</option>
                                            @foreach ($permission as $permission_each)
                                            <option value="{{ $permission_each }}">{{ $permission_each }}</option>
                                            @endforeach
                                        </select>
                                        @error('model.PermissionName')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror


                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--/ Add role form -->
                </div>
            </div>
        </div>
    </div>
    <!--/ Add Role Modal -->
</div>