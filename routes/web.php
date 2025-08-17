<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\RegistrationController;

// Route::get('/index', [UserController::class, 'index'])->name('home');
Route::get('/', [UserController::class, 'index'])->name('home');

Route::get('/about-us', [UserController::class, 'about_us'])->name('about_us');
Route::get('/carr', [UserController::class, 'cars'])->name('cars');
Route::get('/page', [UserController::class, 'pages'])->name('pages');
Route::get('/blog', [UserController::class, 'blogs'])->name('blogs');
Route::get('/contact', [UserController::class, 'contact'])->name('contact');
Route::get('/car_detail', [UserController::class, 'car_detail'])->name('car_detail');

Route::get('/service_detail', [UserController::class, 'service_details'])->name('service_details');

Route::get('/post', [UserController::class, 'post'])->name('post');

Route::get('/car_types', [UserController::class, 'car_types'])->name('car_types');

Route::get('/team_single', [UserController::class, 'team_single'])->name('team_single');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');


Route::get('/login', [AdminController::class, 'login'])->name('login');
Route::post('/login/auth', [AdminController::class, 'login_auth'])->name('login_auth');
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/brands', [BrandController::class, 'index'])->name('brands');
    Route::get('/brands/create', [BrandController::class, 'create'])->name('brand.create');
    Route::get('/available-cars', [RegistrationController::class, 'showAvailableCars'])->name('available.cars');

    Route::post('/brands/store', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/brands/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('/brands/update/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::get('/brands/delete/{id}', [BrandController::class, 'destroy'])->name('brand.delete');

    Route::get('/models', [ModelController::class, 'index'])->name('models');
    Route::post('/models/store', [ModelController::class, 'store'])->name('model.store');
    Route::get('/models/edit/{id}', [ModelController::class, 'edit'])->name('model.edit');
    Route::post('/models/update/{id}', [ModelController::class, 'update'])->name('model.update');
    Route::get('/models/delete/{id}', [ModelController::class, 'destroy'])->name('model.delete');

    // Optional: create route, if you're using create.blade.php just to redirect
    Route::get('/models/create', function () {
        return redirect()->route('model.index', ['add' => 1]);
    })->name('model.create');

    Route::get('/registration', [RegistrationController::class, 'registration'])->name('registration');
    Route::get('/get_model/{id}', [ModelController::class, 'get_model'])->name('get_model');

    Route::post('/car/registration', [RegistrationController::class, 'car_register'])->name('car_register');


    Route::get('/car/edit/{id}', [RegistrationController::class, 'edit'])->name('car.edit');
    Route::put('/car/update/{id}', [RegistrationController::class, 'update'])->name('car.update');
    Route::get('/car/create', [RegistrationController::class, 'create'])->name('car.create');
    Route::post('/car/store', [RegistrationController::class, 'car_register'])->name('car.store');
    Route::get('/get_model/{id}', [RegistrationController::class, 'get_model'])->name('get_model');


    Route::delete('/admin/car/{id}/delete', [RegistrationController::class, 'delete'])->name('car.delete');
    Route::get('/admin/bookings', [BookingController::class, 'index'])->name('booking.index');
});
