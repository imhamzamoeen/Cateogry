<div>

    <livewire:role-cards-component />
    <div class="row">
        <livewire:add-new-role-card-component />
        <livewire:add-user-role-card-component>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Role with Permission</h4>
                </div>

                <hr class="my-0" />
                <div class="card-datatable">
                    <livewire:role-permission-table />
                </div>
            </div>
        </div>
    </div>

      


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">Role With User</h4>
                </div>

                <hr class="my-0" />
                <div class="card-datatable">
                    <livewire:role-user-table/>
                </div>
            </div>
        </div>
    </div>

    
    <livewire:add-role-modal-component />
    {{--
    <livewire:role-edit-modal-component /> --}}

    <livewire:add-user-role-modal-component />
</div>