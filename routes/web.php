<?php

use App\Livewire\AboutUs;
use App\Livewire\CategoryIndex;
use App\Livewire\DeliveryPolicy;
use App\Livewire\HomePage;
use App\Livewire\PaymentPolicy;
use App\Livewire\PostIndex;
use App\Livewire\ProductIndex;
use App\Livewire\ShowCart;
use App\Livewire\ShowCategory;
use App\Livewire\ShowOrder;
use App\Livewire\ShowPost;
use App\Livewire\ShowProduct;
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

Route::get('/danh-muc/{category}', ShowCategory::class)->name('category.show');
Route::get('/danh-muc', CategoryIndex::class)->name('category.index');

Route::get('/thuoc/{medicine}', ShowProduct::class)->name('product.show');
Route::get('/thuoc', ProductIndex::class)->name('product.index');

Route::get('/bai-viet/{post}', ShowPost::class)->name('post.show');
Route::get('/bai-viet', PostIndex::class)->name('post.index');

Route::get('/gio-hang', ShowCart::class)->name('cart.show');
Route::get('/don-hang', ShowOrder::class)->name('order.show');

Route::get('/gioi-thieu', AboutUs::class)->name('about_us');
Route::get('/chinh-sach-giao-hang', DeliveryPolicy::class)->name('delivery');
Route::get('/chinh-sach-thanh-toan', PaymentPolicy::class)->name('payment');
