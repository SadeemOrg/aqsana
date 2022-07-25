<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TripBookingController;
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


Route::post('/register_login_social_media', [AuthController::class, 'register_login_social_media']);
Route::post('/login_social_media', [AuthController::class, 'login_social_media']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/user/update', [AuthController::class, 'update']);
});

Route::post('/update_fcm_token', [AuthController::class, 'update_fcm_token']);


// setting api
Route::get('/about_us', [SettingController::class, 'about_us']);
Route::get('/contact_us', [SettingController::class, 'contact_us']);
Route::post('/report_problem', [SettingController::class, 'report_problem']);

//volunteer api
Route::post('/volunteer_project', [VolunteerController::class, 'store']);
Route::post('/cancel_volunteering', [VolunteerController::class, 'cancel_volunteering']);
Route::get('/get_volunteering_user', [VolunteerController::class, 'get_volunteering_user']);



//Trip Booking api
Route::post('/trip_booking', [TripBookingController::class, 'store']);
Route::post('/cancel_trip_booking', [TripBookingController::class, 'cancel_trip_booking']);
Route::get('/get_trip_booking_user', [TripBookingController::class, 'get_trip_booking_user']);


// Route::group(['middleware' => ['auth:sanctum']], function () {
//     Route::post('/update_fcm_token', [AuthController::class, 'update_fcm_token']);
// });

Route::resource('News', NewsController::class);
