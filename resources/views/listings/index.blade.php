<x-layout>

  @if( session('success') )
  <div class="alert alert-success">
    <h4>{{ session('success') }}!</h4>
  </div>
  @endif

  @if( session('unsuccess') )
  <div class="alert alert-danger">
    <h4>Your purchase failed!</h4>
    @foreach(session('unsuccess') as $product)
    <p>Item: {{ $product['stock_name'] }}, Reason: {{ $product['error'] }}</p>
    @endforeach
  </div>
  @endif

  <!-- Section-->

  <!-- <link href="/assets/css/style.css" rel="stylesheet">
<div class="parent-element">
<a href="/cust-announcement" class="announcement-button">View Announcements</a>
</div> -->
  <!-- <br> -->

  <!-- Header-->
  <header class="bg-dark py-0">
    <div id="carouselExampleCaptions" class="carousel slide">
      <div class="carousel-indicators">
        <?php for ($i = 0; $i < sizeof($announcements); $i++) { ?>
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
        <div class="carousel-item <?php if ($corousel_active == 0) echo "active"; ?>">
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
    <br>
    <form class="form-inline" action="/">
      <div class="input-group justify-content-center">
        <div class="form-outline col-sm-8">
          <input type="search" name="search" placeholder="search..." class="form-control" />
        </div>
        <button type="submit" class="btn btn-dark">Search
        </button>
      </div>
    </form>
    <section class="py-1">
      <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
          @unless(count($listings) == 0)
          @foreach($listings as $listing)
          {{-- <h2> <a href="/listings/{{$listing['id']}}"> {{$listing['title']}} </a></h2>
          <p> {{$listing['description'] }}</p> --}}
          <x-listing-card :listing='$listing' />

          @endforeach
          @else
          <p>No listings found</p>
          @endunless
        </div>
      </div>
    </section>
    <div class="d-flex justify-content-center">
      {{ $listings->links() }}
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="{{ asset('/js/fs-custom.js') }}"></script>