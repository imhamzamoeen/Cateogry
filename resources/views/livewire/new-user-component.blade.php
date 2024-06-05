<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Create New User

                </h4>
            </div>

            <hr class="my-0" />
            <div class="card-body">
                <form id="register-user-personal-detail-form" wire:submit.prevent="submit">
                    <div class="content-header">

                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="vertical-modern-name">Name</label>
                            <input type="text" class="form-control @error('Model.name') is-invalid @enderror" 
                            wire:model.debounce.300ms="Model.name" placeholder="Sir"  tabindex="1" />
                            @error('Model.name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="vertical-modern-email">Email</label>
                            <input type="email" class="form-control @error('Model.email') is-invalid @enderror" 
                                wire:model.debounce.300ms="Model.email" placeholder="example@example.com" 
                                tabindex="1" />
                            @error('Model.email')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-12">
                            <div class="input-group input-group-merge form-password-toggle">
                                <input type="password"
                                    class="form-control form-control-merge @error('Model.password') is-invalid @enderror"
                                    id="login-password"   wire:model.debounce.300ms="Model.password" tabindex="2"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                   />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye-off"></i></span>
                                @error('Model.password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="vertical-modern-username">User Type</label>
                            <select class="form-control @error('Model.user_type') is-invalid @enderror"
                            wire:model.debounce.300ms="Model.user_type">
                                <option value="">Choose User Type</option>
                                @can('Super-Admin-View')
                                <option value="Super_Admin">Super Admin</option>
                                @endcan
                                <option value="Admin">Admin</option>
                                <option value="Accountant">Accountant</option>
                                <option value="User">User</option>

                            </select>
                            @error('Model.user_type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="vertical-modern-email">Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                            wire:model.debounce.300ms="image" aria-describedby="" tabindex="1" />
                            @error('image')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
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
                    <div class="row">
                        <div class="col-md-10">

                        </div>
                        <div class="col-md-2">
                            <button type="submit" style="float: right" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>