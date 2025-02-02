<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Add New Item

                </h4>
            </div>

            <hr class="my-0" />
            <div class="card-body">
                <form id="unit_add_form" wire:submit.prevent="submit">
                    <div class="content-header">

                    </div>
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
                            <select class="form-control @error('Categoryval') is-invalid @enderror"
                                wire:model.debounce.300ms="Categoryval">
                                <option value="">Choose a Category</option>
                                @foreach ($category as $key => $node)
                                <option value="{{ $node }}">{{$key}}</option> 
                            @endforeach
                            </select>
                            <label class="form-label" for="vertical-modern-email">Sub Category </label>
                            <select class="form-control @error('Model.SubCategory_id') is-invalid @enderror"
                                wire:model.debounce.300ms="Model.SubCategory_id">
                                <option value="">Choose a Category</option>
                                @foreach ($subcategory as $key => $node)
                                <option value="{{ $node }}">{{$key}}</option> 
                            @endforeach
                            </select>

                            @error('Model.SubCategory_id')
                            <span class="text-danger">{{$message}}</span>
                            @enderror

                        </div>
                    </div>
                    <div class="row">
                    <div class="mb-1 col-md-6">
                        <label class="form-label" for="vertical-modern-price">Price</label>
                        <input type="number" min="0" class="form-control @error('Model.price') is-invalid @enderror"
                            wire:model.debounce.300ms="Model.price" placeholder="Price" tabindex="1" />
                        @error('Model.price')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-1 col-md-6">
                        <label class="form-label" for="vertical-modern-quantity">Quantity</label>
                        <input type="number" min="0" class="form-control @error('Model.quantity') is-invalid @enderror"
                            wire:model.debounce.300ms="Model.quantity" aria-describedby="quantity" placeholder="Quantity" tabindex="1" />
                        @error('Model.quantity')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
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