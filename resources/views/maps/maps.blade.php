<x-layout>

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
    <!--Google Maps-->

    <h1 class="mt-5" style="text-align: center;">Our Location</h1>
    <p class="mb-5" style="text-align: center;"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15891.109201125077!2d100.2568321!3d5.2974097!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4528b2c4b709c0a2!2sFajar%20Bayu%20Enterprise!5e0!3m2!1sen!2smy!4v1673777055059!5m2!1sen!2smy" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></p>


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