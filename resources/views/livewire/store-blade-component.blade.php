<div class="row">

    <div class="col-lg-12">
        <div class="input-group input-group-merge mb-2">
            <input type="text" wire:model.debounce.300ms="search" class="form-control search-product" id="shop-search"
                placeholder="Search Product" aria-label="Search..." aria-describedby="shop-search">
            <span class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="feather feather-search text-muted">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg></span>
        </div>
        <div class="content-detached ">
            <div class="content-body">
                @forelse ($items as $eachitem)
                <div class="col-md-6 col-lg-4">
                    <div class="card">
                        <img class="card-img-top" src="{{asset('images/item/item').'/'.$eachitem->image}}" alt="Item">
                        <div class="card-body">
                            <h4 class="card-title">{{$eachitem->name}} </h4>
                            <h5 class="card-title" style="color:blue;font-size:15px">

                                {{$eachitem->SubCategory->Category->name}}</h5>
                            <h6 class="card-title" style="color:red;font-size:15px"><strong>Quantity : </strong>{{$eachitem->quantity}} </h6>
                            <p class="card-text">
                                {{$eachitem->description}}
                            </p>
                            <a wire:click="$emit('ProductInModal', {{$eachitem->id}})"
                                class="btn btn-outline-primary waves-effect">Product In</a>
                        </div>
                    </div>
                </div>
                @empty
                No Product Yet
                @endforelse
                
            </div>
        </div>
    </div>
</div>

<livewire:store-in-product-modal-component />