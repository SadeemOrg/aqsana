<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index'])->name('Home');

Route::get('/aboutus', [HomeController::class, 'aboutus'])->name('aboutus');
Route::get('/conctus', [HomeController::class, 'conctus'])->name('conctus');
Route::get('/our-news', [HomeController::class, 'news'])->name('news');
Route::get('/our-project/{id}/', [HomeController::class, 'getnewDetail']);


// Route::get('/ ', function () {
//     return view('home');
// });

// Route::get('/aboutus', function (){
//     return view('about-us-page');
// });

Route::get('our-project', function (){
    return view('projects-page');
});
// Route::get('our-project/1', function (){
//     return view('project-details-page');
// });
//

Route::get('project-donations', function (){
    return view('project-donations');
});

Route::get('/yearly-news', function (){
    return view('yearly-news');
});

// Route::get('/our-news', function (){
//     return view('our-news');
// });
Route::get('news/1', function (){
    return view('single-news');
});
Route::get('/contact', function (){
    return view('contact-page');
});

Route::get('/projects-for-donations', function (){
    return view('projects-for-donations');
});
Route::get('/donation-details/1', function (){
    return view('project-donation-details');
});

