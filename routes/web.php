<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationTest;



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


Route::post("first/", [HomeController::class, "first"])->name('first');
Route::post("Sectors/", [HomeController::class, "Sectors"])->name('Sectors');

Route::get("/cars",[HomeController::class,'index']);

Route::get("toastr-notification", [HomeController::class, "showToastrMessages"]);


Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/من-نحن', [HomeController::class, 'aboutus'])->name('aboutus');
Route::get('/conctus', [HomeController::class, 'conctus'])->name('conctus');
Route::get('/Almuahada', [HomeController::class, 'Almuahada'])->name('Almuahada');
Route::get('/category/{maintype}/{type}', [HomeController::class, 'news'])->name('news');
Route::get('/categor/{title}/{id}/', [HomeController::class, 'getnewDetail'])->name('getnewDetail');



// projects for donation
Route::get('/project-donations', [HomeController::class, 'projectdonation'])->name('projectdonation');

// project details by id for donation
Route::get('/project-donations/{id}', [HomeController::class, 'getdonationDetail'])->name('getdonationDetail');


Route::get('/donation', [HomeController::class, 'donations'])->name('donations');

Route::get('/donation/{id}', [HomeController::class, 'donation'])->name('donation');




Route::get('/sector/{sector}', [HomeController::class, 'sector'])->name('sector');

Route::get('/contact-us', function (){
    return view('Pages.contact-page');
});

Route::get('/search', [HomeController::class, 'pagesearch'])->name('pagesearch');

Route::get('/search/{val}/', [HomeController::class, 'search'])->name('search');

// Route::get('/searchpage', [HomeController::class, 'searchpage'])->name('searchpage');

Route::get('/project', [HomeController::class, 'project'])->name('project');
Route::get('/project/{id}', [HomeController::class, 'getprojectDetail'])->name('getprojectDetail');
Route::get('/projectapi/{id}', [HomeController::class, 'getprojectDetailapi'])->name('getprojectDetailapi');

Route::get('/testNotfiy', function (){
    return view('Pages.testNotfiy');
});

// Library
Route::get('/library', [HomeController::class, 'library'])->name('library');
Route::get('/librarydetail/{id}', [HomeController::class, 'libraryDetail'])->name('libraryDetail');
Route::get('/librarysearch/{search}', [HomeController::class, 'librarySearch'])->name('librarySearch');
Route::get('/librarySearchType/{id}', [HomeController::class, 'librarySearchType'])->name('librarySearchType');


Route::get('bill/{id}', [HomeController::class, 'bills'])->name('bills');

// Route::get('bill', [HomeController::class, 'billsPdf']);


Route::get('/landingPage', function (){

    return view('almowahde.landingPage');
});

Route::get('/payPal', function (){

    return view('almowahde.PayPal');
});

Route::get('/SendNotificationTest',[NotificationTest::class,'sendNotfiy'])->name('sendNotfiy');


