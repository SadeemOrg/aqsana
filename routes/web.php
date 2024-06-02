<?php

use App\Exports\ExportDonations;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessagingController;
use App\Http\Controllers\NotificationTest;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\WebNotificationController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;


// use App\Http\Livewire\Notification;

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

Route::get('/Carbon', function () {
    dd( Carbon::now());
});
Route::get('/sms', function () {
   return view('sms');
});
Route::post('/send-message', [MessagingController::class, 'sendMessage']);
Route::post('/send-text', [MessagingController::class, 'sendText'])->name('send.text');




Route::get('/reports/show-orders', function () {
    return Excel::download(new ExportDonations, 'test.csv');
});
Route::controller(ExportExcelController::class)->group(function () {
    Route::post('submit-form', 'submit')->name('submit-form');
    Route::get('indexexpo', 'index');
    Route::get('export/excel', 'ExportDonations')->name('export.excel');
    Route::get('export/ExportWorkHours', 'ExportWorkHours')->name('export.ExportWorkHours');
    Route::get('export/ExportDonations', 'ExportDonations')->name('export.ExportDonations');
    Route::get('export/ExportPaymentVoucher', 'ExportPaymentVoucher')->name('export.ExportPaymentVoucher');
    Route::get('export/ExportDelegates', 'ExportDelegates')->name('export.ExportDelegates');
    Route::get('export/ExportAlhisalat', 'ExportAlhisalat')->name('export.ExportAlhisalat');
    Route::get('export/ExportUsers', 'ExportUsers')->name('export.ExportUsers');
    Route::get('export/ExportAreas', 'ExportAreas')->name('export.ExportAreas');
    Route::get('export/ExportCites', 'ExportCites')->name('export.ExportCites');
    Route::get('export/ExportAddress', 'ExportAddress')->name('export.ExportAddress');
    Route::get('export/ExportBusesCompany', 'ExportBusesCompany')->name('export.ExportBusesCompany');
    Route::get('export/ExportReport', 'ExportReport')->name('export.ExportReport');

});


Route::get('/send', function () {


    $SERVER_API_KEY = 'AAAAA_Hl3RU:APA91bG0Fqxoqxi703Ov637hTwDZx99ezBvlcpETyJOyXod65v2Wp9KVM-Bk_uGAYGyBmTpjbcp_RO9B8Y9P_AhM9K1DuB10zEHriHAFRcmrGrSMIQdKg-Scf05TWgN5ugdwnipdY3mv';

    $token_1 = 'd1mhabCqQtKn0F5-YMQL-d:APA91bGvtwf8VUPxb7Tt9b3lsdvhPaV9rZFTgI1mQaJ1RYnJ5urv8hUyhp8ASD6r8XFn4DoxGd7TvplBBVIV-svCjT0XuNzNLkEw-0Z6LsXThDrY1PHr5x88AUDnex-p35fUURGbhie2';

    $data = [

        "registration_ids" => [
            $token_1
        ],

        "notification" => [

            "title" => 'Welcome',

            "body" => 'Description',

            "sound" => "default" // required for sound on ios

        ],

    ];

    $dataString = json_encode($data);

    $headers = [

        'Authorization: key=' . $SERVER_API_KEY,

        'Content-Type: application/json',

    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

    $response = curl_exec($ch);

    dd($response);
});
Route::post("user", [HomeController::class, "user"])->name('user');
Route::post("users", [HomeController::class, "users"])->name('users');
Route::post("UserAdmin", [HomeController::class, "Admin"])->name('Admin');

Route::get("schedulelast", [HomeController::class, "schedulelast"])->name('schedulelast');

Route::get('/export', 'ExportController@export')->name('export');
Route::get('/delete-all-data', 'ExportController@deleteAllData')->name('delete.all.data');


Route::post("first/", [HomeController::class, "first"])->name('first');
Route::post("Sectors/", [HomeController::class, "Sectors"])->name('Sectors');
Route::post("getType", [HomeController::class, "getType"])->name('getType');
Route::get("getType", [HomeController::class, "getType"])->name('getType');



Route::post("get-sectors/", [HomeController::class, "getSectors"])->name('get-sectors');
Route::post("get-project/", [HomeController::class, "getProject"])->name('get-project');


Route::post("delet/", [HomeController::class, "delet"])->name('delet');

Route::post("SectorsBudget", [HomeController::class, "SectorsBudget"])->name('SectorsBudget');
Route::post("Sectorstatistics", [HomeController::class, "Sectorstatistics"])->name('Sectorstatistics');
Route::post("total-sector-budget", [HomeController::class, "SectorYearstatistics"])->name('SectorYearstatistics');

Route::post("year", [HomeController::class, "year"])->name('year');
Route::post("DeleteYears", [HomeController::class, "DeleteYears"])->name('DeleteYears');
Route::post("DeleteYears", [HomeController::class, "DeleteYears"])->name('DeleteYears');

Route::post("save", [HomeController::class, "save"])->name('save');

Route::get("SendMessageSms", [HomeController::class, "SendMessage"])->name('SendMessage');

Route::post("SendMessage", [HomeController::class, "SendMessage"])->name('SendMessage');

Route::post("SectorsPill/", [HomeController::class, "SectorsPill"])->name('SectorsPill');


Route::get("/cars", [HomeController::class, 'index']);

Route::get("toastr-notification", [HomeController::class, "showToastrMessages"]);


Route::get('/', [HomeController::class, 'index'])->name('page.index');
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


Route::get('/sector/{id}', [HomeController::class, 'sector'])->name('sector');
Route::get('/Qawafel-Alaqsa', [HomeController::class, 'qawafel'])->name('qawafel');

Route::get('/contact-us', [HomeController::class, 'contactus']);

Route::get('/contact-us/donation', [HomeController::class, 'contactusDonation']);

Route::get('/search', [HomeController::class, 'pagesearch'])->name('pagesearch');



Route::get('/search/{val}/', [HomeController::class, 'search'])->name('search');

// Route::get('/searchpage', [HomeController::class, 'searchpage'])->name('searchpage');

Route::get('/project', [HomeController::class, 'project'])->name('project');
Route::get('/project/{id}', [HomeController::class, 'getprojectDetail'])->name('getprojectDetail');
Route::get('/projectapi/{id}', [HomeController::class, 'getprojectDetailapi'])->name('getprojectDetailapi');

Route::get('/testNotfiy', function () {
    return view('Pages.testNotfiy');
});


Route::get('/privacy-policy', function () {
    return View('Pages.privacy-policy');
});

// Library
Route::get('/library', [HomeController::class, 'library'])->name('library');
Route::get('/librarydetail/{id}', [HomeController::class, 'libraryDetail'])->name('libraryDetail');
Route::get('/librarysearch/{search}', [HomeController::class, 'librarySearch'])->name('librarySearch');
Route::get('/librarySearchType/{id}', [HomeController::class, 'librarySearchType'])->name('librarySearchType');


Route::get('originalbill/{id}', [HomeController::class, 'originalbillbills'])->name('originalbill');
Route::get('bill/{id}', [HomeController::class, 'bills'])->name('bill');
Route::get('/mainbill/{id}', [HomeController::class, 'mainbill'])->name('mainbill');
Route::get('/SendMail', [HomeController::class, 'SendMail'])->name('SendMail');
// Route::post('/SendMail', [HomeController::class, 'SendMail'])->name('SendMail');

// Route::get('bill', [HomeController::class, 'billsPdf']);


Route::get('/landingPage', function () {

    return view('almowahde.landingPage');
});


// Route::get('/try', function (){

//     return view('Pages.Try');
// });




Route::get('/SendNotificationTest', [NotificationTest::class, 'sendNotfiy'])->name('sendNotfiy');


Route::get('sendbasicemail', 'HomeController@basic_email');
Route::get('sendhtmlemail', 'HomeController@html_email');
Route::get('sendattachmentemail', 'HomeController@attachment_email');


Route::get('Admin/userprofile', [HomeController::class, 'userprofile'])->name('userprofile');


Route::get('/send-notification', [NotificationController::class, 'sendOfferNotification']);
Route::post('/sendNotification', [NotificationController::class, 'sendNotification'])->name('sendNotification');
Route::post('/myNotification', [NotificationController::class, 'myNotification'])->name('myNotification');
Route::post('/myAlert', [NotificationController::class, 'myAlert'])->name('myAlert');

Route::post('/AdminNotifications', [NotificationController::class, 'AdminNotifications'])->name('AdminNotifications');

Route::post('/receivedNotifications', [NotificationController::class, 'receivedNotifications'])->name('receivedNotifications');
Route::post('/WorkOnNotifications', [NotificationController::class, 'WorkOnNotifications'])->name('WorkOnNotifications');

Route::post('/CompletNotifications', [NotificationController::class, 'CompletNotifications'])->name('CompletNotifications');
Route::post('/UNCompletNotifications', [NotificationController::class, 'UNCompletNotifications'])->name('UNCompletNotifications');
Route::post('/AddNoteNotifications', [NotificationController::class, 'AddNoteNotifications'])->name('AddNoteNotifications');
Route::post('/DeleteNotifications', [NotificationController::class, 'DeleteNotifications'])->name('DeleteNotifications');



Route::post('user/update', [HomeController::class, "updateuser"])->name('updateuser');
Route::post('/user/update/personaldata', [HomeController::class, "updatepersonaldata"])->name('updatepersonaldata');
Route::post('/user/update/bankdata', [HomeController::class, "updatebankdata"])->name('updatebankdata');
Route::post('/user/update/password', [HomeController::class, "updatepassword"])->name('updatepassword');

Route::get("/WorkHours", [HomeController::class, "WorkHours"])->name('WorkHours');
Route::get("/WorkHoursUser", [HomeController::class, "WorkHoursUser"])->name('WorkHoursUser');
Route::get("/StartTimerWorkHours", [HomeController::class, "StartTimerWorkHours"])->name('StartTimerWorkHours');


Route::get('generate-pdf/{id}', [PDFController::class, 'generatePDF'])->name('generate-pdf');

Route::get('generate-pdf-hours', [PDFController::class, 'generatePDFHours'])->name('generate-pdf-hours');

Route::get('send-sms-notification', [NotificationController::class, 'sendSmsNotificaition']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/push-notificaiton', [WebNotificationController::class, 'index'])->name('push-notificaiton');
Route::post('/store-token', [WebNotificationController::class, 'storeToken'])->name('store.token');
Route::post('/send-web-notification', [WebNotificationController::class, 'sendWebNotification'])->name('send.web-notification');
