<?php

// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");

?>

<x-layout>
@if ($errors->any())
        <div class="text-danger">
            <div>{{ __('Whoops! Something went wrong.') }}</div>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

  <!-- Header-->
  <header class="bg-dark py-0">
    <div id="carouselExampleCaptions" class="carousel slide">
      <div class="carousel-indicators">
        <?php for($i = 0; $i < sizeof($announcements); $i++) { ?>
          <?php if ($i == 0) { ?>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <?php } else { ?>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?= $i ?>" aria-label="Slide <?= $i + 1 ?>"></button>
          <?php } ?>
        <?php } ?>
      </div>
      <div class="carousel-inner">
        <?php $corousel_active = 0; ?>
        @foreach($announcements as $announcement)
        <div class="carousel-item <?php if($corousel_active == 0) echo "active"; ?>">
          <img src="https://img.freepik.com/premium-vector/megaphone-with-important-announcement-flat_149152-517.jpg?w=2000" class="d-block w-100" alt="..." style="max-height: 300px; opacity: 0.3;">
          <div class="carousel-caption d-md-block">
            <h5>{{ $announcement->announcement_name }}</h5>
            <p>{{ $announcement->announcement_description }}.</p>
          </div>
        </div>
        <?php $corousel_active++; ?>
        @endforeach
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </header>
  <main>
    <div class="container my-5">
      <!-- <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h2>Checkout form</h2>
        <p class="lead">Below is an example form built entirely with Bootstrap's form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
      </div> -->

      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Your cart</span>
            <span class="badge badge-secondary badge-pill">3</span>
          </h4>
          <ul class="list-group mb-3">

            <?php
            $total_price = 0;
            $quantity_valid = true;
            $quantity_valid_per_product = true;
            $quantity_invalid_message = "<small class='text-danger mx-3'>Insufficient stock!</small>";

            if(!$products)  $quantity_valid = false;
            ?>

            @foreach($products as $product)
            
            <?php
                $total_price += ($product['product_price'] * $product['product_checkout_quantity']);
                if($product['product_checkout_quantity'] > $product['product_quantity'])
                {
                    $quantity_valid = false;
                    $quantity_valid_per_product = false;
                    
                    if ($product['product_quantity'] == 0) $quantity_invalid_message = "<small class='text-danger mx-3'>Out of stock!</small>";
                }
            ?>

            <li class="list-group-item d-flex justify-content-between lh-condensed">
                <img src="{{ $product['product_image'] ? asset('storage/' . $product['product_image']) : asset("https://dummyimage.com/450x300/dee2e6/6c757d.jpg") }}" style="width: 45px; max-height: 45px;" alt="">
              <div>
                <h6 class="my-0 mx-3">{{ $product['product_name'] }}</h6>
                <!-- <small class="text-muted">{{ $product['product_checkout_quantity'] }} / {{ $product['product_quantity'] }} -->
                    <?php if(!$quantity_valid_per_product) echo $quantity_invalid_message; ?>
                <!-- </small> -->
              </div>
              <span class="text-muted">{{ $product['product_checkout_quantity'] }} <strong>X</strong> RM {{ $product['product_price'] }}</span>
            </li>

            <?php $quantity_valid_per_product = true; ?>

            @endforeach

            <!-- <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Second product</h6>
                <small class="text-muted">Brief description</small>
              </div>
              <span class="text-muted">$8</span>
            </li> -->

            <!-- <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Third item</h6>
                <small class="text-muted">Brief description</small>
              </div>
              <span class="text-muted">$5</span>
            </li> -->

            <!-- <li class="list-group-item d-flex justify-content-between bg-light">
              <div class="text-success">
                <h6 class="my-0">Promo code</h6>
                <small>EXAMPLECODE</small>
              </div>
              <span class="text-success">-$5</span>
            </li> -->
            
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (MYR)</span>
              <strong>RM <?= $total_price ?></strong>
            </li>
          </ul>

          <!-- <form class="card p-2">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Promo code">
              <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">Redeem</button>
              </div>
            </div>
          </form> -->
        </div>
        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Shipping address</h4>
          <form action="/checkout" method="POST" class="needs-validation" novalidate="">
                
            @csrf

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" id="firstName" placeholder="Ronaldo" value="{{ old('first_name') }}" name="first_name" required="" <?php if(!$quantity_valid) { echo 'disabled'; } ?> >
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" id="lastName" placeholder="Messi" value="{{ old('last_name') }}" name="last_name" required="" <?php if(!$quantity_valid) { echo 'disabled'; } ?> >
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>

            <!-- <div class="mb-3">
              <label for="username">Username</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">@</span>
                </div>
                <input type="text" class="form-control" id="username" placeholder="Username" required="" <?php if(!$quantity_valid) { echo 'disabled'; } ?> >
                <div class="invalid-feedback" style="width: 100%;">
                  Your username is required.
                </div>
              </div>
            </div> -->

            <div class="mb-3">
              <label for="email">Email <span class="text-muted"></span></label>
              <input type="email" class="form-control" id="email" name="email" required placeholder="ronaldo@messi.com" value="{{ old('email') }}"  <?php if(!$quantity_valid) { echo 'disabled'; } ?>>
              <div class="invalid-feedback">
                Please enter a valid email address for shipping updates.
              </div>
            </div>

            <div class="mb-3">
              <label for="phone">Phone <span class="text-muted"></span></label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="phone">+60</span>
                <input type="text" class="form-control" placeholder="123 4567 890" aria-label="Phone" name="phone" required value="{{ old('phone') }}"  <?php if(!$quantity_valid) { echo 'disabled'; } ?> minlength="6" maxlength="10" >
              </div>
            </div>

            <div class="mb-3">
              <label for="address">Address</label>
              <input type="text" class="form-control" id="address" placeholder="USM, Gelugor" required="" name="address1" value="{{ old('address1') }}" <?php if(!$quantity_valid) { echo 'disabled'; } ?>>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

            <div class="mb-3">
              <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
              <input type="text" class="form-control" id="address2" placeholder="Apartment or suite" name="address2" value="{{ old('address2') }}" <?php if(!$quantity_valid) { echo 'disabled'; } ?> >
            </div>

            <div class="row">
              <div class="col-md-5 mb-3">
                <label for="country">Country</label>
                <select class="form-select custom-select d-block w-100" id="country" required="" disabled >
                  <option value="">Choose...</option>
                  <option value="malaysia" selected>Malaysia</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid country.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="state">State</label>
                <select class="form-select custom-select d-block w-100" id="state" required="" disabled >
                  <option value="">Choose...</option>
                  <option value="penang" selected>Penang</option>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid state.
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="zip">Zip</label>
                <input type="text" class="form-control" id="zip" placeholder="11800" required="" name="zip" value="{{ old('zip') }}" <?php if(!$quantity_valid) { echo 'disabled'; } ?> minlength="5" maxlength="5">
                <div class="invalid-feedback">
                  Zip code required.
                </div>
              </div>
            </div>
            <!-- <hr class="mb-4"> -->
            <!-- <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="same-address" <?php if(!$quantity_valid) { echo 'disabled'; } ?> >
              <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
            </div> -->
            <!-- <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="save-info" <?php //if(!$quantity_valid) { echo 'disabled'; } ?> >
              <label class="custom-control-label" for="save-info">Save this information for next time</label>
            </div> -->
            <hr class="mb-4">

            <h4 class="mb-3">Payment</h4>

            <div class="d-block my-3">
              <div class="custom-control custom-radio">
                <input id="fpx" name="payment_method" type="radio" class="custom-control-input" value="fpx" onchange="paymentDetail();" checked required="" <?php if(!$quantity_valid) { echo 'disabled'; } ?> >
                <label class="custom-control-label" for="fpx">FPX Online Banking</label>
              </div>
              <div class="custom-control custom-radio">
                <input id="card" name="payment_method" type="radio" class="custom-control-input" value="card" onchange="paymentDetail();" required="" <?php if(!$quantity_valid) { echo 'disabled'; } ?> >
                <label class="custom-control-label" for="card">Credit/Debit card</label>
              </div>
              <!-- <div class="custom-control custom-radio">
                <input id="debit" name="payment_method" type="radio" class="custom-control-input" required="" <?php if(!$quantity_valid) { echo 'disabled'; } ?> >
                <label class="custom-control-label" for="debit">Debit card</label>
              </div> -->
            </div>
            <div id="card-detail">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="cc-name">Name on card</label>
                  <input type="text" class="form-control" id="cc-name" placeholder="" required="" <?php if(!$quantity_valid) { echo 'disabled'; } ?> >
                  <small class="text-muted">Full name as displayed on card</small>
                  <div class="invalid-feedback">
                    Name on card is required
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="cc-number">Credit card number</label>
                  <input type="text" class="form-control" id="cc-number" placeholder="" required="" <?php if(!$quantity_valid) { echo 'disabled'; } ?> >
                  <div class="invalid-feedback">
                    Credit card number is required
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3 mb-3">
                  <label for="cc-expiration">Expiration</label>
                  <input type="text" class="form-control" id="cc-expiration" placeholder="" required="" <?php if(!$quantity_valid) { echo 'disabled'; } ?> >
                  <div class="invalid-feedback">
                    Expiration date required
                  </div>
                </div>
                <div class="col-md-3 mb-3">
                  <label for="cc-expiration">CVV</label>
                  <input type="text" class="form-control" id="cc-cvv" placeholder="" required="" <?php if(!$quantity_valid) { echo 'disabled'; } ?> >
                  <div class="invalid-feedback">
                    Security code required
                  </div>
                </div>
              </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit" <?php if(!$quantity_valid) { echo 'disabled'; } ?> >Continue to checkout</button>
          </form>
        </div>
      </div>

      <!-- <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">© 2017-2018 Company Name</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacy</a></li>
          <li class="list-inline-item"><a href="#">Terms</a></li>
          <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
      </footer> -->
    </div>
  </main>
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

<script>

  paymentDetail();

  function paymentDetail() {

    const radioButtons = document.querySelectorAll('input[name="payment_method"]');
    
    let selectedPaymentMethod;
    
    for (const radioButton of radioButtons) {
      if (radioButton.checked) {
        selectedPaymentMethod = radioButton.value;
        break;
      }
    }
    
    if (selectedPaymentMethod == 'card')
    {
      document.getElementById('card-detail').classList.remove('d-none');
    }
    else
    {
      document.getElementById('card-detail').classList.add('d-none');
    }

  }
  
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="{{ asset('/js/fs-custom.js') }}"></script>