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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/من-نحن', [HomeController::class, 'aboutus'])->name('aboutus');
Route::get('/conctus', [HomeController::class, 'conctus'])->name('conctus');
Route::get('/category/{maintype}/{type}', [HomeController::class, 'news'])->name('news');
Route::get('/categor/{title}/{id}/', [HomeController::class, 'getnewDetail'])->name('getnewDetail');

Route::get('/search', [HomeController::class, 'pagesearch'])->name('pagesearch');

Route::get('/donation', [HomeController::class, 'donation'])->name('donation');

Route::get('/sector/{sector}', [HomeController::class, 'sector'])->name('sector');

Route::get('/contact-us', function (){
    return view('Pages.contact-page');
});
Route::get('/search/{val}/', [HomeController::class, 'search'])->name('search');

Route::get('our-project', function (){
    return view('projects-page');
});
Route::get('our-project/1', function (){
    return view('Pages.project-details-page');
});


Route::get('project-donations', function (){
    return view('Pages.project-donations');
});

Route::get('/annual-news', function (){
    return view('Pages.annual-news');
});

Route::get('/geniral-donations', function (){
    return view('Pages.geniral-donation');
});

Route::get('/contact', function (){
    return view('Pages.contact-page');
});


Route::get('/testNotfiy', function (){
    return view('Pages.testNotfiy');
});

Route::get('/SendNotificationTest',[NotificationTest::class,'sendNotfiy'])->name('sendNotfiy');

Route::get('/projects-for-donations', function (){
    return view('projects-for-donations');
});
Route::get('/donation-details/1', function (){
    return view('project-donation-details');
});

