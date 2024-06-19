<x-layout>
  <section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
      <div class="row gx-4 gx-lg-5 align-items-center">
        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{ $product->stock_image ? asset('storage/' . $product->stock_image) : asset('https://dummyimage.com/450x300/dee2e6/6c757d.jpg') }}" alt="..." /></div>
        <div class="col-md-6">
          <div class="small mb-1">SKU: M4U-{{ $product['stock_id'] }}</div>
          <h1 class="display-5 fw-bolder" id="item-name-{{ $product->stock_id }}">{{ $product['stock_name'] }}</h1>
          <div class="fs-5 mb-5">
            <span class="text-decoration-line-through">RM {{ $product['stock_price'] + 10 }}</span>
            <br>
            RM <span id="item-price-{{ $product->stock_id }}">{{ $product['stock_price'] }}</span>
          </div>
          <p class="lead">{{ $product['stock_description'] }}</p>
          <div class="d-flex">
            <input class="form-control text-center me-3" id="quantity_{{ $product->stock_id }}" <?php if ($product->stock_quantity < 1) echo "disabled"; ?> type="number" value="1" max="{{ $product->stock_quantity }}" min="1" style="max-width: 3rem" />
            <form action="" method="POST" onsubmit="return false;">
              @csrf
              <button class="btn btn-outline-dark flex-shrink-0" type="button" <?php if ($product->stock_quantity < 1) echo "disabled"; ?> onclick="getCart('{{ $product["stock_id"] }}')" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi-cart-fill me-1"></i>
                Add to cart
              </button>
            </form>
            <div class="modal-dialog-centered ms-3">Max Quantity:&nbsp;
              <span id="max-quantity-{{ $product->stock_id }}">{{ $product->stock_quantity }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</x-layout>


<!-- Add To Cart Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div id="cart-bg-color-alert" class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add To Cart Successful!</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div>
          <span id="cart-modal-exceeded-quantity">You have exceeded of the item's maximum quantity!</span>
          <span id="cart-modal-title-h2">You have successfully added an item to the cart!
            <br>
            <br>
          </span>
          <span id="cart-modal-item-name">Item Name: <strong><span id="add-to-cart-item-name">Bread</span></strong>
            <br>
          </span>
          <span id="cart-modal-item-quantity">Quantity: <strong><span id="add-to-cart-item-quantity">0</span></strong>
            <br>
          </span>
          <span id="cart-modal-item-price">Price: <strong>RM <span id="add-to-cart-item-price">0.00</span></strong>
            <br>
          </span>
          <span id="cart-modal-item-total-price">Total Price: <strong>RM <span id="add-to-cart-item-total-price">0.00</span></strong></span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Okay</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>


<!-- Cart Modal -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="cartModalLabel">Your Cart</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-body">
            <span id="items-cart"></span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="{{ asset('/js/fs-custom.js') }}"></script>