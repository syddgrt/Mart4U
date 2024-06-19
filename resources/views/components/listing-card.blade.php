@props(['listing'])

<div class="col mb-5">
    <a href="/product/{{ $listing->stock_id }}" style="text-decoration: none;">
        <div class="card h-100">
            <!-- Sale badge-->
            <!-- {{-- <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div> --}} -->
            <!-- Product image-->
            <!-- {{-- <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." /> --}} -->
            <!-- {{-- {{$img = Image::make('foo.jpg')->resize(300, 200);}} --}} -->
            <div class="text-center mt-4">
                <img class="card-img-top" src="{{$listing->stock_image ? asset('storage/' . $listing->stock_image) : asset("https://dummyimage.com/450x300/dee2e6/6c757d.jpg")}}" style= "height: 250px; width: 200px;"/>
            </div>
            <!-- Product details-->
            <div class="card-body p-4 pb-2">
                <div class="text-center">
                    <!-- Product name-->
                    <h5 class="fw-bolder text-black" id="item-name-{{ $listing->stock_id }}">{{$listing->stock_name}}</h5>
                    <div class="d-flex justify-content-center small text-warning mb-2">
                    <a tabindex="0" class="bi bi-info-circle-fill" role="button" data-bs-toggle="popover" data-bs-trigger="focus" title="Description" data-bs-content="{{$listing->stock_description}}"></a>
                    </div>
                    <!-- Product reviews-->
                    {{-- <div class="d-flex justify-content-center small text-warning mb-2">
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        
                    </div> --}}
                    <!-- Product price-->
                    {{-- <span class="text-muted text-decoration-line-through">$20.00</span> --}}
                    <div class="mb-2"><strong>RM <span id="item-price-{{ $listing->stock_id }}">{{$listing->stock_price}}</span></strong></div>
                    <?php if($listing->stock_quantity == 0) { echo '<p class="text-danger">Out of stock!</p>'; } ?>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Qty</span>
                        <input type="number" id="quantity_{{ $listing->stock_id }}" class="form-control" max="{{$listing->stock_quantity}}" min="1" value="1" <?php if($listing->stock_quantity == 0) { echo 'disabled'; } ?>>
                        <span class="input-group-text"> / <span id="max-quantity-{{ $listing->stock_id }}">{{$listing->stock_quantity}}</span> pcs</span>
                    </div>

                </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center">
                    <form action="" method="POST" onsubmit="return false;">
                        @csrf

                        <button class="btn btn-outline-dark mt-auto" type="button" href="#" id="{{ $listing->stock_id }}" onclick="getCart('{{ $listing->stock_id }}')" <?php if($listing->stock_quantity == 0) { echo 'disabled'; } ?> data-bs-toggle="modal" data-bs-target="#exampleModal">Add To Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </a>
</div>