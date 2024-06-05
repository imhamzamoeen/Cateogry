<div>
    <!-- Add Role Modal -->
    <div class="modal fade SubCategoryEditModal" id="SubCategoryEditModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-5 pb-5">
                    <div class="text-center mb-4">
                        <h1 class="role-title">Edit Sub Category</h1>
                        <p>Edit Sub Category Details</p>
                    </div>
                    <!-- Add role form -->
                    <form method="POST" wire:submit.prevent="EditSubmit" class="SubCategoryEditForm">
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
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="vertical-modern-name">Name</label>
                                        <input type="text" class="form-control @error('Model.name') is-invalid @enderror"
                                            wire:model.debounce.300ms="Model.name" placeholder="Category Name" tabindex="1" />
                                        @error('Model.name')
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
                                    <div class="mb-1 col-md-8">
                                        <label class="form-label" for="vertical-modern-email">Description</label>
                                        <textarea type="password"
                                            class="form-control form-control-merge @error('Model.description') is-invalid @enderror"
                                            id="description" wire:model.debounce.300ms="Model.description" tabindex="2"
                                            placeholder="Category Description" rows="3" cols="33">
            
                                            </textarea>
            
                                        @error('Model.description')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
            
                                    </div>
                                    <div class="mb-1 col-md-4">
                                        <label class="form-label" for="vertical-modern-email">Category </label>
                                        <select class="form-control @error('Model.category_id') is-invalid @enderror"
                                            wire:model.debounce.300ms="Model.category_id">
                                            <option value="">Choose a Category</option>
                                            @foreach ($category as $key => $node)
                                            <option value="{{ $node }}">{{$key}}</option> 
                                        @endforeach
                                        </select>
            
                                        @error('Model.category_id')
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