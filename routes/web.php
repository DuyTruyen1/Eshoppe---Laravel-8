<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\BlogsController;
use App\Http\Controllers\Frontend\TrangChuController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\RegisterController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\BlogDetailController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\AddProductController;
use App\Http\Controllers\Frontend\EditProductController;
use App\Http\Controllers\Frontend\ProductDetailController;
use App\Http\Controllers\Frontend\ShowCategoryAndBrand;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Mail\MailController;
use App\Http\Controllers\Frontend\SearchController;





use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;


use App\Models\Account;
use App\Models\Category;
use Illuminate\Support\Facades\Auth; // Import Auth
use Illuminate\Support\Facades\Mail;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
$user = Auth::user();

//Login manager Route
Route::group([
    'namespace' => 'Admin',
    'middleware' => ['admin']
], function () {
Route::get('/home', [UserController::class, 'index'])->name('home');
Route::post('/admin/users', [UserController::class, 'update'])->name('admin.users');

//Profile
Route::get('/admin/dashboard', [DashboardController::class, 'index']);
Route::get('/admin/users', [UserController::class, 'index']);

//Country
Route::get('/admin/country', [CountryController::class, 'index']);
Route::get('/admin/country', [CountryController::class, 'index'])->name('Table.country');
Route::get('/admin/country/add', [CountryController::class, 'add'])->name('add');
Route::post('/admin/country/add',[CountryController::class,'insert'])->name('insert');
Route::get('/admin/country/edit/{id}', [CountryController::class, 'getEdit'])->name('Table.edit');
Route::post('/admin/country/edit/{id}', [CountryController::class, 'updateCountry']);
Route::get('/admin/country/delete/{id}', [CountryController::class, 'delete'])->name('Table.delete');

//Category
Route::get('/admin/category', [CategoryController::class, 'index']);
Route::get('/admin/category', [CategoryController::class, 'index'])->name('Category.category');

// Route::get('/frontend', [ShowCategoryAndBrand::class, 'index']);

Route::get('/admin/category/add', [CategoryController::class, 'add'])->name('add');
Route::post('/admin/category/add',[CategoryController::class,'insert'])->name('insert');
Route::get('/admin/category/edit/{id}', [CategoryController::class, 'getEdit'])->name('Category.edit');
Route::post('/admin/category/edit/{id}', [CategoryController::class, 'updateCategory']);
Route::get('/admin/category/delete/{id}', [CategoryController::class, 'delete'])->name('Category.delete');

//Brand
Route::get('/admin/brand', [BrandController::class, 'index']);
Route::get('/admin/brand', [BrandController::class, 'index'])->name('Brand.brand');
Route::get('/admin/brand/add', [BrandController::class, 'add'])->name('add');
Route::post('/admin/brand/add',[BrandController::class,'insert'])->name('insert');
Route::get('/admin/brand/edit/{id}', [BrandController::class, 'getEdit'])->name('Brand.edit');
Route::post('/admin/brand/edit/{id}', [BrandController::class, 'updateBrand']);
Route::get('/admin/brand/delete/{id}', [BrandController::class, 'delete'])->name('Brand.delete');

//Blogs
Route::get('/admin/blog', [BlogsController::class, 'index'])->name('Blogs.addBlog');
Route::get('/admin/blog', [BlogsController::class, 'index'])->name('Blogs.blog');
Route::get('/admin/blog/add', [BlogsController::class, 'addBlog'])->name('Blogs.addBlog');
Route::post('/admin/blog/add',[BlogsController::class,'insert'])->name('insert');
Route::get('/admin/blog/edit/{id}', [BlogsController::class, 'getEdit'])->name('Blogs.editBlog');
Route::post('/admin/blog/edit/{id}', [BlogsController::class, 'updateBlog']);
Route::get('/admin/blog/delete/{id}', [BlogsController::class, 'delete'])->name('Blogs.delete');
});


Route::group([
    'namespace' => 'Frontend',
], function () {
    Route::get('frontend/trangchu', [TrangChuController::class, 'index'])->name('frontend.trangchu');
    Route::get('frontend/product', [ProductController::class, 'index'])->name('frontend.product');
    //Blogs
    Route::get('/frontend/blog-list', [BlogController::class, 'index'])->name('blog.show');
    Route::get('/frontend/blog-detail', [BlogDetailController::class, 'index']);
    Route::get('/blog/{id}', [BlogDetailController::class,'show'])->name('blog.show');

    //Search
    Route::get('/search', [SearchController::class, 'search'])->name('search');
    Route::post('/search-advanced', [SearchController::class, 'searchPost'])->name('product.search');
    // routes/web.php
    Route::post('/products/filter', [SearchController::class, 'filter'])->name('products.filter');


    Route::group(['Middleware' => 'memberNotLogin'], function () {
    Route::get('frontend/register', [RegisterController::class, 'index'])->name('frontend.registerForm');
    Route::post('frontend/register', [RegisterController::class, 'register'])->name('frontend.register');
    Route::get('frontend/login', [LoginController::class, 'index'])->name('frontend.loginForm');
    Route::post('frontend/login', [LoginController::class, 'login'])->name('frontend.login');
    });

    Route::group(['middleware' => 'member'], function () {

    Route::get('frontend/menu', [AccountController::class, 'home'])->name('menu');
    Route::get('frontend/account', [AccountController::class, 'index'])->name('account.menu');
    Route::get('frontend/accounts', [AccountController::class, 'index'])->name('account');
    Route::post('frontend/account/update', [AccountController::class, 'update'])->name('account.updateProfile');
    Route::get('account/my-product', [AccountController::class, 'myProducts'])->name('account.myProduct');

    //add product
    Route::get('frontend/add-product', [AddProductController::class, 'index']);
    Route::get('frontend/add-product', [AddProductController::class, 'showCategoryAndBrand'])->name('add-product');
    Route::post('/products', [AddProductController::class, 'store'])->name('product.store');
    Route::get('/products/search', [ProductController::class, 'search'])->name('product.search');

    //edit product
    Route::get('frontend/edit-product', [EditProductController::class, 'index'])->name('edit-product');
    Route::get('/edit-product/{id}', [EditProductController::class, 'show'])->name('product.edit');
    Route::post('/edit-product/{id}', [EditProductController::class, 'updateProduct'])->name('update');
    Route::get('/delete/{id}', [EditProductController::class, 'delete'])->name('delete');

    //product detail
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

    //addtocart
    Route::post('/addToCart', [ProductDetailController::class,'addToCart'])->name('addToCart');
    Route::get('/get-cart-count', [ProductDetailController::class, 'getCartCount'])->name('getCartCount');
    Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::get('frontend/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('updateCart');

    
    //checkout
    Route::get('frontend/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/update', [CheckoutController::class, 'updateCartCheckout'])->name('updateCartCheckout');
    Route::post('/register-order', [CheckoutController::class, 'registerOder'])->name('frontend.register-order');

    //Mail
    Route::get('/test', [MailController::class, 'index']);
    Route::post('/order', [CheckoutController::class, 'submitOrder'])->name('frontend.order');

    Route::post('/blog/rate/ajax', [BlogDetailController::class, 'rateBlog'])->name('blog.rate.ajax');
    Route::post('/blog/{id}', [BlogDetailController::class, 'comment'])->name('postComment');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    });

});



