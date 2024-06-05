<div>
    <!-- Add Role Modal -->
    <div class="modal fade UserEditModal" id="UserEditModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-5 pb-5">
                    <div class="text-center mb-4">
                        <h1 class="role-title">Edit User</h1>
                        <p>Edit user Details</p>
                    </div>
                    <!-- Add role form -->
                    <form method="POST" wire:submit.prevent="EditSubmit" class="UserEditForm">
                        @csrf
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Edit Details</h3>
                                <div class="block-options">
                                    <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                                    <button type="button" data-bs-dismiss="modal"
                                        class="btn btn-sm btn-primary">Cancel</button>

                                </div>
                            </div>
                            <div class="block-content">
                                <div class="row justify-content-center py-sm-3 py-md-5">
                                    <div class="form-group col-md-6">
                                       
                                        <label class="form-label" for="vertical-modern-name">Name</label>
                                        <input type="text"
                                            class="form-control @error('User.name') is-invalid @enderror"
                                            wire:model.debounce.300ms="User.name" />
                                        @error('User.name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-email">Email</label>
                                        <input type="email"
                                            class="form-control @error('User.email') is-invalid @enderror"
                                            wire:model.debounce.300ms="User.email" placeholder="example@example.com"
                                            tabindex="1" />
                                        @error('User.email')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row justify-content-center py-sm-3 py-md-5">
                                    <div class="form-group col-md-4">
                                        <label for="Certificate">Password</label>
                                        <input type="password"
                                            class="form-control form-control-merge @error('User.password') is-invalid @enderror"
                                            id="login-password" wire:model.debounce.300ms="User.password" tabindex="2"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        
                                        @error('User.password')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4"> <label for="Certificate">User Type</label>
                                        <select class="form-control @error('User.user_type') is-invalid @enderror"
                                            wire:model.debounce.300ms="User.user_type">
                                            <option value="{{$User['user_type']}}" selected>{{$User['user_type']}}</option>
                                            <option value="">Choose User Type</option>
                                            @can('Super-Admin-View')
                                            <option value="Super_Admin">Super Admin</option>
                                            @endcan
                                            <option value="Admin">Admin</option>
                                            <option value="Accountant">Accountant</option>
                                            <option value="User">User</option>

                                        </select>
                                        @error('User.user_type')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="form-label" for="vertical-modern-email">Image</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                        wire:model.debounce.300ms="image" aria-describedby="" tabindex="1" />
                                        @error('image')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                                @if ($image)
                                                @error('image')
                                                <span class="text-danger">{{$message}}</span>
                    
                                                @else
                                                Photo Preview:
                                                <img src="{{ $image->temporaryUrl() }}" style="    height: 300px;
                                                width: 100%;
                                                margin-top: 10px;
                                                margin-bottom: 10px;">
                                                @enderror
                                                @endif
                                            </div>
                                        </div>
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