<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header border-bottom">
                <h4 class="card-title">Add New Income Detail

                </h4>
            </div>

            <hr class="my-0" />
            <div class="card-body">
                <form id="income_add_form" wire:submit.prevent="submit">
                    <div class="content-header">

                    </div>

                    <div class="row">
                        <div class="mb-1 col-md-8">
                            <label class="form-label" for="vertical-modern-email">Description</label>
                            <textarea type="password"
                                class="form-control form-control-merge @error('Model.description') is-invalid @enderror"
                                id="description" wire:model.debounce.300ms="Model.description" tabindex="2"
                                placeholder="Category Description" rows="5" cols="33">

                                </textarea>
                            @error('Model.description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror

                        </div>
                        <div class="mb-1 col-md-4">
                            <div class="row">
                                <label class="form-label" for="vertical-modern-email">Category </label>
                                <select class="form-control @error('Categoryval') is-invalid @enderror"
                                    wire:model.debounce.300ms="Categoryval">
                                    <option value="">Choose a Category</option>
                                    @foreach ($category as $key => $node)
                                    <option value="{{ $node }}">{{$key}}</option>
                                    @endforeach
                                </select>
                                @error('Categoryval')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <label class="form-label" for="vertical-modern-email">Sub Category </label>
                                <select class="form-control @error('SubCategoryval') is-invalid @enderror"
                                    wire:model.debounce.300ms="SubCategoryval">
                                    <option value="">Choose a Category</option>
                                    @foreach ($subcategory as $key => $node)
                                    <option value="{{ $node }}">{{$key}}</option>
                                    @endforeach
                                </select>

                                @error('SubCategoryval')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <label class="form-label" for="vertical-modern-email">Unit </label>
                                <select class="form-control @error('Model.unit_id') is-invalid @enderror"
                                    wire:model.debounce.300ms="Model.unit_id">
                                    <option value="">Choose a Unit</option>
                                    @foreach ($unit as $key => $node)
                                    <option value="{{ $node }}">{{$key}}</option>
                                    @endforeach
                                </select>

                                @error('Model.unit_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="vertical-modern-price">Status</label>
                            <select class="form-control @error('Model.status') is-invalid @enderror"
                            wire:model.debounce.300ms="Model.status">
                            <option value="">Choose Status</option>
                            <option value="signed">Signed</option>
                            <option value="hold">Hold</option>

                        </select>

                        @error('Model.status')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="vertical-modern-quantity">Total Amount</label>
                            <input type="number" min="0"
                                class="form-control @error('Model.total_amount') is-invalid @enderror"
                                wire:model.debounce.300ms="Model.total_amount" aria-describedby="quantity"
                                placeholder="Total Amount" tabindex="1" />
                            @error('Model.total_amount')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="vertical-modern-quantity">Share Amount</label>
                            <input type="number" min="0"
                                class="form-control @error('Model.share_amount') is-invalid @enderror"
                                wire:model.debounce.300ms="Model.share_amount" aria-describedby="quantity"
                                placeholder="Share Amount" tabindex="1" />
                            @error('Model.share_amount')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mb-1 col-md-6">
                            <label class="form-label" for="vertical-modern-quantity">Shared By</label>
                            <input type="text" 
                                class="form-control @error('Model.share_by') is-invalid @enderror"
                                wire:model.debounce.300ms="Model.share_by" aria-describedby="quantity"
                                placeholder="Shared By" tabindex="1" />
                            @error('Model.share_by')
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