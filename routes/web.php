<?php

use App\Livewire\Category;
use App\Livewire\HomePage;
use App\Livewire\Medication;
use App\Livewire\Post;
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

Route::get('/', HomePage::class)->name('homepage');
Route::get('/danh-muc/{category:slug}', Category::class)->name('categories');
Route::get('/thuoc/{medication:slug}', Medication::class)->name('products');
Route::get('/bai-viet/{post:slug}', Post::class)->name('posts');
