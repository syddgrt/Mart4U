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

    <section class="section contact">
        <div class="row gy-4">
            <div class="card">
                <div class="card-body">
                <div class="col-12">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="info-box card px-3 py-3"> <i class="bi bi-geo-alt"></i>
                            <h3>Address</h3>
                            <p>{{ env('COMPANY_ADDRESS1') }}, {{ env('COMPANY_ADDRESS2') }}<br>{{ env('COMPANY_ZIP') }}, {{ env('COMPANY_COUNTRY') }}</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-box card px-3 py-3"> <i class="bi bi-telephone"></i>
                            <h3>Call Us</h3>
                            <p><a style="text-decoration: none;" href="tel:+6{{ env('COMPANY_PHONE') }}">+6{{ env('COMPANY_PHONE') }}</a><br><a style="text-decoration: none;" href="tel:+6{{ env('COMPANY_PHONE') }}">+6{{ env('COMPANY_PHONE') }}</a></p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-box card px-3 py-3"> <i class="bi bi-envelope"></i>
                            <h3>Email Us</h3>
                            <p><a style="text-decoration: none;" href="mailto:{{ env('MAIL_USERNAME') }}">{{ env('MAIL_USERNAME') }}</a></p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="info-box card px-3 py-3"> <i class="bi bi-clock"></i>
                            <h3>Open Hours</h3>
                            <p>Monday - Friday<br>9:00AM - 05:00PM</p>
                        </div>
                    </div>
                </div>
            </div>
                </div>
            </div>
            <!-- <div class="col-xl-6">
                <div class="card p-4">
                    <form action="forms/contact.php" method="post" class="php-email-form">
                        <div class="row gy-4">
                            <div class="col-md-6"> <input type="text" name="name" class="form-control" placeholder="Your Name" required=""></div>
                            <div class="col-md-6 "> <input type="email" class="form-control" name="email" placeholder="Your Email" required=""></div>
                            <div class="col-md-12"> <input type="text" class="form-control" name="subject" placeholder="Subject" required=""></div>
                            <div class="col-md-12"><textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea></div>
                            <div class="col-md-12 text-center">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div> <button type="submit">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> -->
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