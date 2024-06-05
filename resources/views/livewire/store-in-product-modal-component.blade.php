<div>
    <!-- Add Role Modal -->
    <div class="modal fade ProductInModal" id="ProductInModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-5 pb-5">
                    <div class="text-center mb-4">
                        <h1 class="role-title">Product In</h1>
                        <p>Provide details</p>
                    </div>
                    <!-- Add role form -->
                    <form method="POST" wire:submit.prevent="EditSubmit" class="ProductInForm">
                        @csrf
                        <div class="block">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Please Provide Details</h3>
                                <div class="block-options">
                                    <button type="submit" class="btn btn-sm btn-primary">Add</button>
                                    <button type="button" data-bs-dismiss="modal"
                                        class="btn btn-sm btn-primary">Cancel</button>

                                </div>
                            </div>
                            <div class="block-content">
                                <div class="row justify-content-center py-sm-3 py-md-5">
                                    <div class="form-group col-md-6">
                                       
                                        <label class="form-label" for="vertical-modern-name">Quantity</label>
                                        <input type="number" min="0"
                                            class="form-control @error('quantity') is-invalid @enderror"
                                            wire:model.debounce.300ms="quantity" />
                                        @error('quantity')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="vertical-modern-email">Type</label>
                                        <select class="form-control @error('type') is-invalid @enderror"
                                        wire:model.debounce.300ms="type">
                                        <option value="">Choose User Type</option>
                                        <option value="in">Product IN</option>
                                        <option value="out">Product Out</option>
                                     

                                    </select>
                                    @error('type')
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