<div>
    <!-- Add Role Modal -->
    <div class="modal fade AddPermissionModal" id="AddPermissionModal" tabindex="-1" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-5 pb-5">
                    <div class="text-center mb-4">
                        <h1 class="role-title">Add New Permission</h1>
                    </div>
                    <!-- Add role form -->
                    <form id="AddPermissionForm" wire:submit.prevent="submit" class="row AddPermissionForm">
                        <div class="col-12">
                            <label class="form-label" for="modalRoleName">Permission Name</label>
                            <input type="text" id="ModalPermisionName" wire:model.lazy="name" class="form-control"
                                class="@error('name') is-invalid @enderror" placeholder="Enter role name" tabindex="-1"
                                data-msg="Please enter permission name" />
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 text-center mt-2">
                            <button type="submit" class="btn btn-primary me-1">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                                Discard
                            </button>
                        </div>
                    </form>
                    <!--/ Add Permission form -->
                </div>
            </div>
        </div>
    </div>
    <!--/ Add Permission Modal -->
</div>