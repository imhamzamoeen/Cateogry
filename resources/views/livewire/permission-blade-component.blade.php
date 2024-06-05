<div>
    <livewire:permission-card-component />
    <div class="row">
        <livewire:add-permission-card-component />
        <livewire:assign-permission-to-user-card>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Permission With User</h4>
                </div>

                <hr class="my-0" />
                <div class="card-datatable">
                    <livewire:user-permission-table />
                </div>
            </div>
        </div>
    </div>

    <livewire:add-permission-modal-component />
    <livewire:assign-permission-to-user-modal-component>


</div>