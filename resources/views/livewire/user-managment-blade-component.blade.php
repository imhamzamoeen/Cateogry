<div class="row">


    <div class="row">
        <div class="mb-2 col-md-12">
           <livewire:new-user-component/>
        </div>
    </div>

    <div class="row">
        <div class="mb-2 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Users</h4>
                </div>
                <div class="card-body" id="user_table_div">
                    <livewire:user-managment-table />
                </div>
            </div>

          
        </div>
    </div>
    <livewire:edit-user-component/>
</div>