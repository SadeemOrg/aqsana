<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\AuthController;
use App\Http\Controllers\DonationsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentMethodsController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TripBookingController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\VolunteerController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//paymnet Api
Route::post('/payment', [PaymentController::class, 'sendMoney']);


Route::post('/register_login_social_media', [AuthController::class, 'register_login_social_media']);
Route::post('/login_social_media', [AuthController::class, 'login_social_media']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/user/update', [AuthController::class, 'update']);

    //donations Api
    Route::get('/donations', [DonationsController::class, 'index']);
    Route::post('/donations-app', [DonationsController::class, 'store']);
    Route::get('/getInformationUser', [AuthController::class, 'getInformationUser']);

    Route::get('/getNearAndBokkingTrip-auth', [TripController::class, 'getNearAndBokkingTrip']);

    Route::get('/trips-auth', [TripController::class, 'index']);

    
});

Route::post('/update_fcm_token', [AuthController::class, 'update_fcm_token']);
Route::post('/reset_password_request', [AuthController::class, 'reset_password_request']);
Route::post('/verification_token', [AuthController::class, 'verification_token']);
Route::post('/update_password', [AuthController::class, 'update_password']);


// setting api
Route::get('/about_us', [SettingController::class, 'about_us']);
Route::get('/contact_us', [SettingController::class, 'contact_us']);
Route::post('/report_problem', [SettingController::class, 'report_problem']);
Route::get('/social_media', [SettingController::class, 'social_media']);

//volunteer api
Route::post('/volunteer_project', [VolunteerController::class, 'store']);
Route::post('/cancel_volunteering', [VolunteerController::class, 'cancel_volunteering']);
Route::get('/get_volunteering_user', [VolunteerController::class, 'get_volunteering_user']);


//Donations api
Route::post('/donations', [DonationsController::class, 'store']);





//Trip Booking api
Route::post('/trip_booking', [TripBookingController::class, 'store']);
Route::post('/cancel_trip_booking', [TripBookingController::class, 'cancel_trip_booking']);
Route::get('/get_trip_booking_user', [TripBookingController::class, 'get_trip_booking_user']);


//Search Trip
Route::get('/search_trip', [TripBookingController::class, 'search_trip']);


//Prrojects
Route::get('/projects', [ProjectController::class, 'index']);


//Prrojects
Route::get('/trips', [TripController::class, 'index']);

Route::get('/getNearAndBokkingTrip', [TripController::class, 'getNearAndBokkingTrip']);


//payment methods
Route::get('paymnet-methods/get-payment-methods', [PaymentMethodsController::class, 'index']);
Route::post('paymnet-methods/store', [PaymentMethodsController::class, 'store']);
Route::post('paymnet-methods/update', [PaymentMethodsController::class, 'update']);
Route::post('paymnet-methods/delete', [PaymentMethodsController::class, 'delete']);


// Route::group(['middleware' => ['auth:sanctum']], function () {
//     Route::post('/update_fcm_token', [AuthController::class, 'update_fcm_token']);
// });

Route::resource('News', NewsController::class);
