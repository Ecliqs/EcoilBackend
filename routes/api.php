<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\NewsfeedController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SEOController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserAddressController;
use App\Models\UserAddress;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get("/testimonials", [TestimonialController::class, "apiIndex"]);
Route::post("/testimonial", [TestimonialController::class, "store"]);

Route::get("/newsfeeds", [NewsfeedController::class, "apiIndex"]);
Route::get("/newsfeeds/all", [NewsfeedController::class, "allNews"]);
Route::get("/newsfeeds/{id}", [NewsfeedController::class, "show"]);


// Get all products api
Route::get("/products", [ProductController::class, "apiIndex"]);

Route::get("/states", [StateController::class, "apiIndex"]);

Route::get("/user-address", [UserAddressController::class, "index"]);

Route::post("/user-address", [UserAddressController::class, "store"]);

Route::delete("/user-address/{id}", [UserAddressController::class, "destroy"]);

Route::get("/cart", [CartController::class, "index"]);

Route::post("/cart/add-product", [CartController::class, "store"]);

Route::put("/cart/quantity/increment", [CartController::class, "quantityIncrement"]);

Route::put("/cart/quantity/decrement", [CartController::class, "quantityDecrement"]);

Route::get("/cart/total", [CartController::class, "total"]);

Route::delete("/cart/remove-product", [CartController::class, "removeProduct"]);

Route::post("/cart/place-order", [OrderController::class, "placeOrder"]);

Route::post("/contact/store", [ContactController::class, "store"]);

Route::get("/seo/page/{page}", [SEOController::class, "getSEOTags"]);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


