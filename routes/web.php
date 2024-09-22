<?php

use App\Exports\ExportDonations;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessagingController;
use App\Http\Controllers\NotificationTest;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\WebNotificationController;
use App\Models\Project;
use App\Models\TelephoneDirectory;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\File;
// use App\Http\Livewire\Notification;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;


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

Route::get('/nova-api/donations', [HomeController::class, 'donationsApi'])->name('donations');
Route::get('/nova-api/reports', [HomeController::class, 'reportsApi'])->name('reports');


// Route::get(
//     '/nova-api/donations',
//     function ()
//     {
//         // Retrieve the transactions based on the criteria
//         $transactions = Transaction::where([
//             ['main_type', 1],
//             ['type', 2],
//             ['is_delete', '<>', 2],
//         ])->orderBy('created_at', 'desc') // Sort by created_at in descending order
//             ->paginate(10); // Adjust the per-page value as needed



//         $statuses = [
//             '1' => __('Not Receive yet'),
//             '2' => __('in a box'),
//             '3' => __('in the bank'),
//         ];
//         $PaymentType = [
//             '1' => __('cash'),
//             '2' => __('shek'),
//             '3' => __('bit'),
//             '4' => __('hawale'),
//             '5' => __('حصالة'),
//             '6' => __('التطبيق'),

//         ];
//         $resources = $transactions->map(function ($transaction) use ( $statuses, $PaymentType) {
//             return [
//                 'fields' => [
//                     [
//                         'attribute' => 'bill_number',
//                         'component' => 'text-field',
//                         'help_text' => null,
//                         "indexName" => __("bill_number"),
//                         "name" => __("bill_number"),
//                         'nullable' => false,
//                         'panel' => null,
//                         'prefix_component' => true,
//                         'readonly' => false,
//                         'required' => false,
//                         'sortable' => false,
//                         'sortable_uri_key' => 'bill_number',
//                         'stacked' => false,
//                         'text_align' => 'left',
//                         'validation_key' => 'bill_number',
//                         'value' => $transaction->bill_number
//                     ],
//                     [
//                         "attribute" => "transaction_date",
//                         "component" => "date",
//                         "helpText" => null,
//                         "indexName" => "تاريخ",
//                         "name" => "تاريخ",
//                         "nullable" => false,
//                         "panel" => null,
//                         "prefixComponent" => true,
//                         "readonly" => false,
//                         "required" => false,
//                         "sortable" => false,
//                         "sortableUriKey" => "transaction_date",
//                         "stacked" => false,
//                         "textAlign" => "left",
//                         "validationKey" => "transaction_date",
//                         "value" => Carbon::parse($transaction->transaction_date)->format('d-m-Y'),
//                     ],
//                     [
//                         "belongsToId" => $transaction->ref_id,
//                         "belongsToRelationship" => "project",
//                         "debounce" => 500,
//                         "displaysWithTrashed" => true,
//                         "label" => "مشروع",
//                         "resourceName" => "projects",
//                         "reverse" => false,
//                         "searchable" => false,
//                         "withSubtitles" => false,
//                         "showCreateRelationButton" => false,
//                         "singularLabel" => "المشروع",
//                         "viewable" => true,
//                         "attribute" => "project",
//                         "component" => "belongs-to-field",
//                         "helpText" => null,
//                         "indexName" => "المشروع",
//                         "name" => "المشروع",
//                         "nullable" => false,
//                         "panel" => null,
//                         "prefixComponent" => true,
//                         "readonly" => false,
//                         "required" => true,
//                         "sortable" => false,
//                         "sortableUriKey" => "ref_id",
//                         "stacked" => false,
//                         "textAlign" => "left",
//                         "validationKey" => "project",
//                         "value" => Project::find($transaction->ref_id)?->project_name,
//                     ],
//                     [


//                         "attribute" => "transaction_status",
//                         "component" => "select-field",
//                         "helpText" => null,
//                         "indexName" => __("transaction_status"),
//                         "name" => __("transaction_status"),
//                         "nullable" => false,
//                         "panel" => null,
//                         "prefixComponent" => true,
//                         "readonly" => false,
//                         "required" => false,
//                         "sortable" => false,
//                         "sortableUriKey" => "transaction_status",
//                         "stacked" => false,
//                         "textAlign" => "left",
//                         "validationKey" => "transaction_status",
//                         "value" =>   $statuses[$transaction->transaction_status] ?? __('Unknown status'),
//                         "options" => [
//                             [
//                                 "label" => "لم يتم التسليم بعد",
//                                 "value" => 1
//                             ],
//                             [
//                                 "label" => "في صندوق",
//                                 "value" => 2
//                             ],
//                             [
//                                 "label" => "في البنك",
//                                 "value" => 3
//                             ]
//                         ],
//                         "searchable" => false,

//                     ],
//                     [
//                         "indexName" => __("ReceiveDonation"),
//                         "name" => __("ReceiveDonation"),
//                         'attribute' => 'ReceiveDonation',
//                         'component' => 'boolean-field',
//                         'help_text' => null,

//                         'nullable' => false,
//                         'panel' => null,
//                         'prefix_component' => true,
//                         'readonly' => false,
//                         'required' => false,
//                         'sortable' => false,
//                         'sortable_uri_key' => 'ReceiveDonation',
//                         'stacked' => false,
//                         'text_align' => 'center',
//                         'validation_key' => 'ReceiveDonation',
//                         'value' => true
//                     ],
//                     [
//                         "indexName" => __("equivalent value"),
//                         "name" => __("equivalent value"),
//                         'component' => 'text-field',
//                         'help_text' => null,
//                         'index_name' => 'قيمة السند',
//                         'nullable' => false,
//                         'panel' => null,
//                         'prefix_component' => true,
//                         'readonly' => false,
//                         'required' => false,
//                         'sortable' => false,
//                         'sortable_uri_key' => 'equivelant_amount',
//                         'stacked' => false,
//                         'text_align' => 'left',
//                         'validation_key' => 'equivelant_amount',
//                         'value' => $transaction->equivelant_amount,
//                     ],
//                     [
//                         "indexName" => __("Donor"),
//                         "name" => __("Donor"),
//                         'attribute' => 'TelephoneDirectory',
//                         'component' => 'belongs-to-field',
//                         'debounce' => 500,
//                         'displays_with_trashed' => true,
//                         'help_text' => null,
//                         'index_name' => 'متبرع',
//                         'label' => 'SMS',
//                         'nullable' => false,
//                         'panel' => null,
//                         'prefix_component' => true,
//                         'readonly' => false,
//                         'required' => true,
//                         'resource_name' => 'telephone-directories',
//                         'reverse' => false,
//                         'searchable' => false,
//                         'show_create_relation_button' => false,
//                         'singular_label' => 'متبرع',
//                         'sortable' => false,
//                         'sortable_uri_key' => 'name',
//                         'stacked' => false,
//                         'text_align' => 'left',
//                         'validation_key' => 'TelephoneDirectory',
//                         'value' =>  TelephoneDirectory::find($transaction->name)?->name, //'קעדאן כאלד יחיא',
//                         'viewable' => true,
//                         'with_subtitles' => false
//                     ],
//                     [
//                         "indexName" => __("Payment Type"),
//                         "name" => __("Payment Type"),
//                         'attribute' => 'Payment_type',
//                         'component' => 'select-field',
//                         'help_text' => null,
//                         'index_name' => 'طريقة الدفع',
//                         'nullable' => false,
//                         'options' => [
//                             ['label' => 'نقد', 'value' => 1],
//                             ['label' => 'شيك', 'value' => 2],
//                             ['label' => 'بيت', 'value' => 3],
//                         ],
//                         'panel' => null,
//                         'prefix_component' => true,
//                         'readonly' => false,
//                         'required' => false,
//                         'searchable' => false,
//                         'sortable' => false,
//                         'sortable_uri_key' => 'Payment_type',
//                         'stacked' => false,
//                         'text_align' => 'left',
//                         'validation_key' => 'Payment_type',
//                         "value" =>   $PaymentType[$transaction->Payment_type] ?? __('Unknown status'),
//                     ],
//                     [
//                         "belongsToId" => $transaction->Created_By,
//                         "belongsToRelationship" => "create",
//                         "debounce" => 500,
//                         "displaysWithTrashed" => true,
//                         "label" => "موظفين اداريين",
//                         "resourceName" => "users",
//                         "reverse" => false,
//                         "searchable" => false,
//                         "withSubtitles" => false,
//                         "showCreateRelationButton" => false,
//                         "singularLabel" => "انشأ بواسطة",
//                         "viewable" => true,
//                         "attribute" => "create",
//                         "component" => "belongs-to-field",
//                         "helpText" => null,
//                         "indexName" => "انشأ بواسطة",
//                         "name" => "انشأ بواسطة",
//                         "nullable" => false,
//                         "panel" => null,
//                         "prefixComponent" => true,
//                         "readonly" => false,
//                         "required" => true,
//                         "sortable" => false,
//                         "sortableUriKey" => "Created_By",
//                         "stacked" => false,
//                         "textAlign" => "left",
//                         "validationKey" => "create",
//                         "value" => User::find($transaction->Created_By)?->name

//                     ],
//                     [
//                         "attribute" => "معاينة",
//                         "component" => "nova-button",
//                         "helpText" => null,
//                         "indexName" => null,
//                         "name" => "معاينة",
//                         "nullable" => false,
//                         "panel" => null,
//                         "prefixComponent" => true,
//                         "readonly" => false,
//                         "required" => false,
//                         "sortable" => false,
//                         "sortableUriKey" => "معاينة",
//                         "stacked" => false,
//                         "textAlign" => "left",
//                         "validationKey" => "معاينة",
//                         "value" => null,
//                         "key" => "معاينة",
//                         "type" => "link",
//                         "link" => [
//                             "href" => "/mainbill/{$transaction->id}?type=bill",
//                             "target" => "_blank"
//                         ],
//                         "text" => "معاينة",
//                         "event" => "NovaButton\\Events\\ButtonClick",
//                         "label" => null,
//                         "route" => null,
//                         "reload" => false,
//                         "confirm" => null,
//                         "visible" => true,
//                         "classes" => [
//                             "nova-button-transaction",
//                             "bg-orange"
//                         ],
//                         "title" => null,
//                         "indexAlign" => "right",
//                         "errorText" => "Failed",
//                         "errorClasses" => "cursor-pointer dim inline-block text-danger font-bold no-underline",
//                         "successText" => "Success",
//                         "successClasses" => "cursor-pointer dim inline-block text-success font-bold no-underline",
//                         "loadingText" => "Loading",
//                         "loadingClasses" => "cursor-pointer dim inline-block text-grey font-bold no-underline"

//                     ],
//                     [
//                         "attribute" => "طباعة",
//                         "component" => "nova-button",
//                         "helpText" => null,
//                         "indexName" => null,
//                         "name" => "طباعة",
//                         "nullable" => false,
//                         "panel" => null,
//                         "prefixComponent" => true,
//                         "readonly" => false,
//                         "required" => false,
//                         "sortable" => false,
//                         "sortableUriKey" => "طباعة",
//                         "stacked" => false,
//                         "textAlign" => "left",
//                         "validationKey" => "طباعة",
//                         "value" => null,
//                         "key" => "طباعة",
//                         "type" => "link",
//                         "link" => [
//                             "href" => "/generate-pdf/{$transaction->id}",
//                             "target" => "_blank"
//                         ],
//                         "text" => "طباعة",
//                         "event" => "NovaButton\\Events\\ButtonClick",
//                         "label" => null,
//                         "route" => null,
//                         "reload" => false,
//                         "confirm" => null,
//                         "visible" => true,
//                         "classes" => [
//                             "nova-button-transaction",
//                             "bg-orange"
//                         ],
//                         "title" => null,
//                         "indexAlign" => "right",
//                         "errorText" => "Failed",
//                         "errorClasses" => "cursor-pointer dim inline-block text-danger font-bold no-underline",
//                         "successText" => "Success",
//                         "successClasses" => "cursor-pointer dim inline-block text-success font-bold no-underline",
//                         "loadingText" => "Loading",
//                         "loadingClasses" => "cursor-pointer dim inline-block text-grey font-bold no-underline"

//                     ],
//                     [
//                         'attribute' => 'is_delete',
//                         'component' => 'row-background',
//                         'help_text' => null,
//                         'index_name' => 'Net In Come',
//                         'name' => 'Net In Come',
//                         'nullable' => true,
//                         'panel' => null,
//                         'prefix_component' => true,
//                         'readonly' => true,
//                         'required' => false,
//                         'sortable' => false,
//                         'sortable_uri_key' => 'Net In Come',
//                         'stacked' => false,
//                         'text_align' => 'center',
//                         'validation_key' => 'Net In Come',
//                         'value' => $transaction->is_delete != 0?[
//                             'backgroundColor' => '#A9A9A9',
//                             'textColor' => '#000000'
//                         ]:null,
//                     ]
//                 ],
//                 'authorizedToCreate' => true,
//                 'authorizedToDelete' => false,
//                 'authorizedToForceDelete' => true,
//                 'authorizedToRestore' => true,
//                 'authorizedToUpdate' =>  $transaction->is_delete != 0?false:true,
//                 'authorizedToView' => true,
//                 'softDeleted' => false,
//                 'softDeletes' => true,
//                 'title' => '1402',
//                 'id' => [
//                     'attribute' => 'id',
//                     'component' => 'id-field',
//                     'helpText' => null,
//                     'indexName' => 'ID',
//                     'name' => 'ID',
//                     'nullable' => false,
//                     'panel' => null,
//                     'prefixComponent' => true,
//                     'readonly' => false,
//                     'required' => false,
//                     'sortable' => false,
//                     'sortableUriKey' => 'id',
//                     'stacked' => false,
//                     'textAlign' => 'left',
//                     'validationKey' => 'id',
//                     'value' => $transaction->id, // Use the actual id value from the transaction
//                     'softDeleted' => false,
//                     'softDeletes' => true,
//                     'title' => (string) $transaction->id, // Convert to string if needed
//                 ],
//             ];
//         });
//         // Prepare the response
//         $response = [
//             'label' => 'سندات قبض',
//             'resources' => $resources, // The detailed transaction data
//             'total' => $transactions->total(),
//             'per_page' => $transactions->perPage(),
//             'current_page' => $transactions->currentPage(),
//             'last_page' => $transactions->lastPage(),
//             'prev_page_url' => $transactions->previousPageUrl(),
//             'next_page_url' => $transactions->nextPageUrl(),
//             'sortable' => true,
//             'softDeletes' => true,
//             'per_page_options' => [10, 25, 50, 100],
//         ];

//         return response()->json($response);
//     }
// );

Route::get("/open-tabs", [HomeController::class, "openTabs"])->name('open-tabs');

Route::get('/app/password/reset/{token}', [ForgotPasswordController::class, 'showForm']);
Route::post('/app/password/reset', [ForgotPasswordController::class, 'update'])->name('password.update.new');


Route::get('/Carbon', function () {
    dd(Carbon::now());
});
Route::get('/sms', function () {
    return view('sms');
});
Route::post('/send-message', [MessagingController::class, 'sendMessage']);
Route::post('/send-text', [MessagingController::class, 'sendText'])->name('send.text');




Route::get('/reports/show-orders', function () {
    return Excel::download(new ExportDonations, 'test.xlsx');
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

Route::post("schedulelast", [HomeController::class, "schedulelast"])->name('schedulelast');
Route::get("schedulelast", [HomeController::class, "schedulelastTest"])->name('schedulelast');



Route::post("first/", [HomeController::class, "first"])->name('first');
Route::post("Sectors/", [HomeController::class, "Sectors"])->name('Sectors');
Route::post("getType", [HomeController::class, "getType"])->name('getType');
Route::get("getType", [HomeController::class, "getType"])->name('getType');

Route::post("getBus", [HomeController::class, "getBus"])->name('getBus');


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
Route::get('/export', 'ExportController@export')->name('export');
Route::get('/delete-all-data', 'ExportController@deleteAllData')->name('delete.all.data');
Route::get('/project', [HomeController::class, 'project'])->name('project');
Route::get('/project/{id}', [HomeController::class, 'getprojectDetail'])->name('getprojectDetail');
Route::get('/projectapi/{id}', [HomeController::class, 'getprojectDetailapi'])->name('getprojectDetailapi');

Route::get('/testNotfiy', function () {
    return view('Pages.testNotfiy');
});


Route::get('/privacy-policy', function () {
    return View('Pages.privacy-policy');
});

Route::get('/library', [HomeController::class, 'library'])->name('library');
Route::get('/librarydetail/{id}', [HomeController::class, 'libraryDetail'])->name('libraryDetail');
Route::get('/librarysearch/{search}', [HomeController::class, 'librarySearch'])->name('librarySearch');
Route::get('/librarySearchType/{id}', [HomeController::class, 'librarySearchType'])->name('librarySearchType');


Route::get('originalbill/{id}/{type?}', [HomeController::class, 'originalbillbills'])->name('originalbill');
Route::get('bill/{id}/{type?}', [HomeController::class, 'bills'])->name('bill');
Route::get('/mainbill/{id}', [HomeController::class, 'mainbill'])->name('mainbill');
Route::get('/SendMail', [HomeController::class, 'SendMail'])->name('SendMail');
Route::post('/SendMail', [HomeController::class, 'SendMail'])->name('SendMail');



Route::get('/landingPage', function () {

    return view('almowahde.landingPage');
});






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


Route::get('generate-pdf/{id}/{type?}', [PDFController::class, 'generatePDF'])->name('generate-pdf');
Route::get('generate-pdfs/{ids}/{type?}', [PDFController::class, 'generatePDFs'])->name('generate-pdfs');

Route::get('generate-pdf-hours', [PDFController::class, 'generatePDFHours'])->name('generate-pdf-hours');

Route::get('send-sms-notification', [NotificationController::class, 'sendSmsNotificaition']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/push-notificaiton', [WebNotificationController::class, 'index'])->name('push-notificaiton');
Route::post('/store-token', [WebNotificationController::class, 'storeToken'])->name('store.token');
Route::post('/send-web-notification', [WebNotificationController::class, 'sendWebNotification'])->name('send.web-notification');
