<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SEOController;
use App\Http\Controllers\ContactController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\NewsfeedController;
use \App\Http\Controllers\TestimonialController;
use App\Models\Contact;
use App\Models\Newsfeed;
use App\Models\Product;
use App\Models\Testimonial;

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

// Route::post('/login',[LoginController::class, "login"] )->name("login");

Auth::routes();


Route::group(["middleware" => "auth"], function (){

    Route::get('/', function () {

        $newsfeeds = Newsfeed::count();
        $testimonials = Testimonial::count();
        $products = Product::count();
        $contacts = Contact::count();

        return view('welcome', ['newsfeeds' => $newsfeeds, "testimonials" => $testimonials, "products" => $products, "contacts" => $contacts]);
    });
    
    Route::get('/newsfeed', [NewsfeedController::class, "index"])->name("newsfeed.index");
    Route::get('/newsfeed/create', [NewsfeedController::class, "create"])->name("newsfeed.create");
    Route::post('/newsfeed/create', [NewsfeedController::class, "store"])->name("newsfeed.store");
    Route::get('/newsfeed/{id}/edit', [NewsfeedController::class, "edit"])->name("newsfeed.edit");
    Route::post('/newsfeed/{id}/update', [NewsfeedController::class, "update"])->name("newsfeed.update");
    Route::get('/newsfeed/{id}/delete', [NewsfeedController::class, "delete"])->name("newsfeed.delete");
    Route::post('/newsfeed/imgupdate', [NewsfeedController::class, "imageUpdate"])->name("newsfeed.imgupdate");
    
    Route::get('/testimonial', [TestimonialController::class, "index"])->name("testimonial.index");
    
    Route::get('/product', [ProductController::class, "index"])->name("product.index");
    Route::get('/product/create', [ProductController::class, "create"])->name("product.create");
    Route::post('/product/create', [ProductController::class, "store"])->name("product.store");
    Route::get('/product/{id}/edit', [ProductController::class, "edit"])->name("product.edit");
    Route::post('/product/{id}/update', [ProductController::class, "update"])->name("product.update");  
    Route::get('/product/{id}/delete', [ProductController::class, "delete"])->name("product.delete");
    Route::post('/product/imgupdate', [ProductController::class, "imageUpdate"])->name("product.imageupdate");

    Route::get("/contact", [ContactController::class, "index"])->name("contact.index");
    
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::post("/testimonial/approve", [TestimonialController::class, "approve"])->name("testimonial.approve");
    
    Route::get("/seo-panel", [SEOController::class, "index"])->name("seo-panel");
    Route::post("/seo-panel/add-tag", [SEOController::class, "addTag"])->name("seo-panel.add-tag");
    Route::post("/seo-panel/add-attribute", [SEOController::class, "addAttribute"])->name("seo-panel.add-attribute");
    Route::post("/seo-panel/delete-attribute", [SEOController::class, "deleteAttribute"])->name("seo-panel.delete-attribute");
    Route::post("/seo-panel/delete-tag", [SEOController::class, "deleteTag"])->name("seo-panel.delete-tag");

});

// Route::get('/user-create', function(){
//     $user = User::create([
//         "name" => "Admin",
//         "email" => "admin@ecoil.com",
//         "password" => Hash::make("12345678")
//     ]);

//     if($user)
//     {
//         return "User created successfully";
//     }

// });


