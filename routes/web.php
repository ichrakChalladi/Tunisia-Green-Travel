<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GuesthouseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransportOptionController;
use App\Http\Controllers\CarbonFootprintByTripController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\ReservationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});


// Login & Registration
Route::prefix('user')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});


Route::resource('evenements', EvenementController::class);


Route::prefix('')->group(function () {

    Route::get('/dashboard', function () {
        return view('template.dashboard');
    })->name('template.dashboard');

    Route::get('/index', function () {
        return view('template.index');
    })->name('template.index');

    Route::get('/tables', function () {
        return view('template.tables');
    })->name('template.tables');

    Route::get('/billing', function () {
        return view('template.billing');
    })->name('template.billing');

    Route::get('/notifications', function () {
        return view('template.notifications');
    })->name('template.notifications');

    Route::get('/profile', function () {
        return view('template.profile');
    })->name('template.profile');
});

Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/product/{product}/update', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{product}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');

// Blog routes
Route::prefix('blog')->group(function () {
    Route::get('/overview/{guesthouseId}', [BlogController::class, 'display'])->name('blog.blogDisplay');
    Route::post('/overview/add-review', [BlogController::class, 'addReview'])->name('blog.addReview');
    Route::delete('/overview/delete-review/{id}', [BlogController::class, 'deleteReview'])->name('blog.deleteReview');
    Route::put('/overview/update-review/{id}', [BlogController::class, 'updateReview'])->name('blog.updateReview');
    Route::get('/reviews', [BlogController::class, 'adminReviews'])->name('blog.blogAdmin');
    Route::post('/reviews/{review}/toggle-status', [BlogController::class, 'toggleStatus'])->name('admin.reviews.toggleStatus');
});

// Reservation routes
Route::prefix('reservations')->group(function () {
    Route::get('/admin', [ReservationController::class, 'backView'])->name('reservations.adminView');
    Route::get('list', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::put('{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::delete('{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
});


// Logout route for both users and admins
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Room routes
Route::get('/room/create/{guesthouseId}', [RoomController::class, 'create'])->name('room.create');
Route::get('/room/{guesthouseId}', [RoomController::class, 'index'])->name('room.index');
Route::get('/rooms-list/{guesthouseId}', [RoomController::class, 'listRoom'])->name('listRoom');Route::post('/room', [RoomController::class, 'booking'])->name('room.booking');
Route::get('/room/{room}/edit', [RoomController::class, 'edit'])->name('room.edit');
Route::delete('/room/{room}/destroy', [RoomController::class, 'destroy'])->name('room.destroy');
Route::put('/room/{room}/update', [RoomController::class, 'update'])->name('room.update');


Route::get('/guesthouse', [GuesthouseController::class, 'index'])->name('guesthouse.index');
Route::get('/guesthouse/create', [GuesthouseController::class, 'create'])->name('guesthouse.create');
Route::post('/guesthouse', [GuesthouseController::class, 'booking'])->name('guesthouse.booking');
Route::get('/guesthouse/{guesthouse}/edit', [GuesthouseController::class, 'edit'])->name('guesthouse.edit');
Route::delete('/guesthouse/{guesthouse}/destroy', [GuesthouseController::class, 'destroy'])->name('guesthouse.destroy');
Route::put('/guesthouse/{guesthouse}/update', [GuesthouseController::class, 'update'])->name('guesthouse.update');
// Additional Guesthouse List Route
Route::get('/guesthouses', [GuesthouseController::class, 'listGuesthouses'])->name('guesthouse.list');



// Carbon Footprint by Trip routes
Route::resource('carbon-footprint-by-trip', CarbonFootprintByTripController::class);
Route::resource('carbon-footprint-by-trips', CarbonFootprintByTripController::class);
Route::get('carbon-footprint-by-trips/{id}/print', [CarbonFootprintByTripController::class, 'print'])->name('carbon-footprint-by-trips.print');


// Transport Option routes
Route::resource('transport-options', TransportOptionController::class);
