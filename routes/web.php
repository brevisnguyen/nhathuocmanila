<?php

use App\Livewire\AllPosts;
use App\Livewire\AllProducts;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\HomePage;
use App\Livewire\PlacedOrder;
use App\Livewire\QuestionAnswerPage;
use App\Livewire\ShowCart;
use App\Livewire\ShowCategory;
use App\Livewire\ShowPost;
use App\Livewire\ShowProduct;
use App\Livewire\User\Profile;
use Illuminate\Support\Facades\Route;

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

Route::get('/', HomePage::class)->name('home');
Route::get('/danh-muc/{category}', ShowCategory::class)->name('category');

Route::get('/thuoc', AllProducts::class)->name('all-products');
Route::get('/thuoc/{product}', ShowProduct::class)->name('product');

Route::get('/bai-viet', AllPosts::class)->name('post-card');
Route::get('/bai-viet/{post}', ShowPost::class)->name('post');

Route::get('/gio-hang', ShowCart::class)->name('cart');
Route::get('/cau-hoi-thuong-gap', QuestionAnswerPage::class)->name('questions');

Route::middleware('auth')->group(function () {
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/dat-hang', PlacedOrder::class)->name('placed-order');
});

/**
 * Authentication
 */
Route::middleware('guest')->group(function () {
    Route::get('/register', Register::class)->name('register');
    Route::get('/login', Login::class)->name('login');
});
