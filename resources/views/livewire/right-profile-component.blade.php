<div class="col-lg-3 col-12 order-3">
    <!-- latest profile pictures -->
    <div class="card">
        <div class="card-body">
            <h5 class="mb-1">Edit Profile <small></small>
            </h5>
            <div class="row">
                <form id="ProifleUpdateForm" wire:submit.prevent="submit" autocomplete="off">
                    @csrf
                    <div class="col-md-12 mb-2">
                        <div class="d-flex justify-content-between">
                            <label for="name" class="form-label">Name</label>
                        </div>
                        <input type="text" wire:model.lazy="Model.name" 
                            class="form-control @error('Model.name') is-invalid @enderror" placeholder="name"
                            autocomplete="false">
                        @error('Model.name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="d-flex justify-content-between">
                            <label for="email" class="form-label">Email</label>
                        </div>
                        <input type="email" wire:model.lazy="Model.email" 
                            class="form-control @error('Model.email') is-invalid @enderror" placeholder="email"
                            autocomplete="false">
                        @error('Model.email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="d-flex justify-content-between">
                            <label for="password" class="form-label">Password</label>
                        </div>
                        <input type="password" wire:model.lazy="Model.password" id="update_password"
                            class="form-control @error('Model.password') is-invalid @enderror" autocomplete="false"
                            placeholder="password">
                        @error('Model.password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror   
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="d-flex justify-content-between">
                        <button class="btn btn-success form-control" type="submit">Update </button>
                        </div>
                       
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--/ latest profile pictures -->
</div>

@push('extended-js')
<script>
    $(function () {
        setTimeout(ClearField, 1000);
      });
     

function ClearField() {
 $('#update_password').val('');
}
</script>

@endpush