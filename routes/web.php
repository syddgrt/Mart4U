<?php

use App\Models\Listing;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AnnouncementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ListingController::class, 'index']); // when navigate to '/' (home page), call index function in ListingController

Route::get('/faqs', function(){ return view('admin.layout.auth.faqs');})->middleware(['auth', 'verified']); // Route for faqs admin

Route::get('/stock', [ListingController::class, 'index2'])->middleware(['auth', 'verified']);

Route::get('/report', [ReportController::class, 'sales'])->middleware(['auth', 'verified']);

// Route::get('/listings/create', [ListingController::class, 'create']); // when navigate to '/listings/create', call create function in ListingController

Route::post('/listings', [ListingController::class, 'store'])->middleware(['auth', 'verified']); // when navigate to '/listings', call store function in ListingController

Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware(['auth', 'verified']); // when navigate to '/listings/{listing}/edit', call edit function in ListingController

Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware(['auth', 'verified']); // when navigate to '/listings/{listing}', call update function in ListingController

Route::get('/product/{listing}', [ListingController::class, 'show']);

Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware(['auth', 'verified']); // when navigate to '/listings/{listing}', call destroy function in ListingController

//Route Announcement

Route::get('/announcement', [AnnouncementController::class, 'announce'])->middleware(['auth', 'verified']);

Route::get('/add-announcement',[AnnouncementController::class, 'create'])->middleware(['auth', 'verified']);

Route::post('/add-announcement',[AnnouncementController::class, 'store'])->middleware(['auth', 'verified']);

// Route::get('/cust-announcement',[AnnouncementController::class, 'cust_announce']);

Route::get('/edit-announcement/{announcement}',[AnnouncementController::class, 'edit'])->middleware(['auth', 'verified']);

Route::put('/edit-announcement/{announcement}', [AnnouncementController::class, 'update'])->middleware(['auth', 'verified']);

Route::delete('/delete-announcement/{announcement}',[AnnouncementController::class, 'destroy'])->middleware(['auth', 'verified']);


// Route for cart
Route::resource('cart', CartController::class);

// Route for checkout
Route::resource('checkout', CheckoutController::class);

// Route for user (admin)
Route::resource('admin', UserController::class)->middleware(['auth', 'verified']);
Route::post('admin/change-password', function(){
    Auth::logout();
    return redirect()->to('/forgot-password');
});

// Route for about us
Route::get('/maps', function () {
    
    $announcements = Announcement::all();

    return view('maps/maps', ['announcements' => $announcements]);
});

// Route for Contact
Route::get('/contact-us', function () {
    
    $announcements = Announcement::all();

    return view('contact/contact', ['announcements' => $announcements]);
});












// $buyer = array(
// 	'name' => 'Aiman Tino',
// 	'address1' => 'Aiman`s Address',
// 	'address2' => 'Addrss 2',
// 	'zip' => '11800',
// 	'phone' => '01234567890',
// 	'email' => 'aiman@gmail.com',
// 	'date' => '01/01/2023',
// 	'payment_method' => 'Card',
// 	'payment_id' => '0001',
// );

// $items = array(
// 	array(
// 		'name' => 'bawang',
// 		'price' => '12.00',
// 		'quantity' => '3',
// 		'total_price' => '36.00',
// 	),
// 	array(
// 		'name' => 'baju',
// 		'price' => '15.00',
// 		'quantity' => '2',
// 		'total_price' => '30.00',
// 	),
// );

// Route::view('ema', 'mail.purchase', ['buyer' => $buyer, 'items' => $items]);