<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Auth\ApiAuthController;



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
  Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::post('/login', [ApiAuthController::class, 'login'])->name('login.api');
    Route::post('/register', [ApiAuthController::class,'register'])->name('register.api');
    Route::post('/logout', [ApiAuthController::class,'logout'])->name('logout.api');

   Route::post('/save-booking', [BookingController::class,'save'])->name('save-booking.api');
   Route::post('/update-booking', [BookingController::class,'update'])->name('update-booking.api');
    Route::post('/booking-list', [BookingController::class,'getUserBookingList'])->name('booking-list.api');
    Route::post('/get-booking', [BookingController::class,'getBooking'])->name('get-booking.api');
    Route::post('/contact-us', [BookingController::class,'contactEmail'])->name('contact-us.api');
    Route::post('/send-otp', [ApiAuthController::class,'sendOTP'])->name('send-otp.api');
    
    Route::post('/varify-otp', [ApiAuthController::class,'varifyOTP'])->name('varify-otp.api');
    Route::post('/change-password', [ApiAuthController::class,'changePassword'])->name('chnage-password.api'); 
     Route::post('/user-change-password', [ApiAuthController::class,'userChangePassword'])->name('user-chnage-password.api');
    Route::post('/update-profile', [ApiAuthController::class,'editProfile'])->name('update-profile.api');
    
    Route::post('/get-services', [BookingController::class,'getServices'])->name('get-services.api');
    
    Route::post('/sign-booking', [BookingController::class,'signBooking'])->name('sign-booking.api');
  });

Route::middleware(['cors', 'json.response','auth:api'])->get('/user', function (Request $request) {
        return $request->user();
    });
    
Route::get('/clear-cache', function() {
    $output = [];
    \Artisan::call('cache:clear', $output);
    \Artisan::call('config:clear', $output);
    \Artisan::call('config:cache', $output);
    
    dd($output);
});

Route::get('/serve', function() {
    $output = [];
    \Artisan::call('serve', $output);
    dd($output);
});