@forelse ($items as $eachitem)
<div class="card ecommerce-card">
    <div class="item-img text-center">
        <a href="app-ecommerce-details.html">
            <img class="img-fluid card-img-top" src="{{asset('images/item/item/').'/'.$eachitem->image}}" alt="product" /></a>
    </div>
    <div class="card-body">
        <div class="item-wrapper">
            <div class="item-rating">
                <ul class="unstyled-list list-inline">
                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                    <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                </ul>
            </div>
            <div>
                <h6 class="item-price">{{$eachitem->price}}</h6>
            </div>
        </div>
        <h6 class="item-name">
            <a class="text-body" href="app-ecommerce-details.html">{{$eachitem->name}}</a>
            <span class="card-text item-company">By <a href="#" class="company-name">{{$eachitem->SubCategory->Category->name}}</a></span>
        </h6>
        <p class="card-text item-description">
            
        </p>
    </div>
    <div class="item-options text-center">
        <div class="item-wrapper">
            <div class="item-cost">
                <h4 class="item-price">{{$eachitem->price}}</h4>
            </div>
        </div>
        <a href="#" class="btn btn-light btn-wishlist">
            <i data-feather="heart"></i>
            <span>Wishlist</span>
        </a>
        <a href="#" class="btn btn-primary btn-cart">
            <i data-feather="shopping-cart"></i>
            <span class="add-to-cart">Add to cart</span>
        </a>
    </div>
</div>
@empty
 No Product Yet
@endforelse