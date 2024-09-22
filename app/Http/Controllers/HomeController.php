<?php

namespace App\Http\Controllers;

use Actengage\Wizard\Session;
// use Alaqsa\Project\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\FormMassage;

use App\Mail\TestMail;
use App\Models\Almuahada;
use App\Models\ArchiveSms;
use App\Models\Area;
use App\Models\Book;
use App\Models\BookType;
use App\Models\Budget;
use App\Models\City;
use App\Models\Donations;
use App\Models\News;
use App\Models\newsType;
use App\Models\Project;
use App\Models\Sector;
use App\Models\SmsType;
use App\Models\TelephoneDirectory;
use App\Models\Transaction;
use App\Models\TripBooking;
use App\Models\User;
use App\Models\WorkHours;
use App\Rules\passwordRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class HomeController extends BaseController
{
    private   function getDaysInMonth($year, $month)
    {
        // Create a Carbon date object for the first day of the given month and year
        $date = Carbon::createFromDate($year, $month, 1);

        // Use Carbon's daysInMonth property to get the number of days in the month
        return $date->daysInMonth;
    }


    public function openTabs(Request $request)
    {
        $urls = $request->get('urls', []);

        return view('open-tabs', compact('urls'));
    }
    public function schedulelast()
    {




        $year = Carbon::now()->year;
        $month = Carbon::now()->month;

        $date_from = $year . '-' . $month . '-1';
        $from = date($date_from);

        $date = Carbon::parse($from)->subYear();
        $schedule = array();
        for ($i = 0; $i < 12; $i++) {
            $year = $date->year;
            $month = $date->month;
            $date_from = $year . '-' . $month . '-1';
            $date_to = $year . '-' . $month . '-' . $this->getDaysInMonth($year, $month);
            $from = date($date_from);
            $to = date($date_to);


            $Transactions = Transaction::whereBetween('transaction_date', [$from, $to])->where("main_type", '1')->where('is_delete', '0')->sum('equivelant_amount');
            $spendingTransactions = Transaction::whereBetween('transaction_date', [$from, $to])->where("main_type", '2')->where('is_delete', '0')->sum('equivelant_amount');


            $pus = array(
                "month" => $month,
                "year" =>  $year,
                "spendingTransactions" => $spendingTransactions,
                "Transactions" =>   $Transactions
            );

            array_push($schedule, $pus);

            $date = $date->addMonth();
        }

        return $schedule;
    }
    public function schedulelastTest()
    {


        $year = Carbon::now()->year;
        $month = Carbon::now()->month;

        $date_from = $year . '-' . $month . '-1';
        $from = date($date_from);

        $date = Carbon::parse($from)->subYear();
        $schedule = array();
        for ($i = 0; $i < 12; $i++) {
            $year = $date->year;
            $month = $date->month;
            $date_from = $year . '-' . $month . '-1';
            $date_to = $year . '-' . $month . '-' . $this->getDaysInMonth($year, $month);
            $from = date($date_from);
            $to = date($date_to);
            $Transactions = Transaction::where("main_type", '1')->where('is_delete', '0')->get();
            $spendingTransactions = Transaction::whereBetween('transaction_date', [$from, $to])->where("main_type", '2')->where('is_delete', '0')->get();

            $pus = array(
                "month" => $month,
                "year" =>  $year,
                "spendingTransactions" => $spendingTransactions,
                "Transactions" =>   $Transactions
            );

            array_push($schedule, $pus);

            $date = $date->addMonth();
        }
        dd($schedule);
        return $schedule;
    }
    public function StartTimerWorkHours(Request $request)
    {


        $user = Auth::user();
        $WorkHours = WorkHours::where('user_id', '=', $user->id)->whereDate('date', Carbon::today())->first();

        if ($WorkHours != null) {

            if ($WorkHours->day_hours != null) {
                if ($WorkHours->on_work != 0) {

                    $starttime = Carbon::parse($WorkHours->fake_time);

                    $finishTime = Carbon::now();

                    // $totalDuration = $starttime->diffInHours($finishTime);
                    $startDate = Carbon::createFromFormat('Y-m-d H:i:s',   $starttime);
                    $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $finishTime);


                    $days = $startDate->diffInDays($endDate);
                    $Hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
                    $minutes = $startDate->copy()->addDays($days)->addHours($Hours)->diffInMinutes($endDate);
                    $Seconds = $startDate->copy()->addDays($days)->addHours($Hours)->addMinute($minutes)->diffInMinutes($endDate);
                    $oldttime = Carbon::parse($WorkHours->day_hours);
                    $Hours += $oldttime->hour;
                    $minutes += $oldttime->minute;
                    $Seconds += $oldttime->second;
                    // // $diff_in_hours =   $to->diffInHours($from);
                    dd($startDate, $endDate,   $Hours, $minutes, $Seconds);
                } else {
                    $starttime = Carbon::parse($WorkHours->day_hours);
                    $Hours = $starttime->hour;
                    $minutes = $starttime->minute;
                    $Seconds = $starttime->second;
                    dd($Hours, $minutes, $Seconds);
                }
            } else {
                $starttime = Carbon::parse($WorkHours->start_time);

                // dd(Carbon::parse($WorkHours[0]->start_time));

                $finishTime = Carbon::now();

                // $totalDuration = $starttime->diffInHours($finishTime);
                $startDate = Carbon::createFromFormat('Y-m-d H:i:s',   $starttime);
                $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $finishTime);


                $days = $startDate->diffInDays($endDate);
                $Hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
                $minutes = $startDate->copy()->addDays($days)->addHours($Hours)->diffInMinutes($endDate);
                $Seconds = $startDate->copy()->addDays($days)->addHours($Hours)->addMinute($minutes)->diffInMinutes($endDate);
                // // $diff_in_hours =   $to->diffInHours($from);
                // $Hours =   $to->diffInHours($from);
                // $minutes =   $to->diffInMinutes($from);
                // $Seconds =   $to->diffInSeconds($from);

                dd($startDate, $endDate,   $Hours, $minutes, $Seconds);
            }
            // dd( $totalDuration);
        } else {
            $Hours = 0;
            $minutes = 0;
            $Seconds = 0;
            dd($Hours, $minutes, $Seconds);
        }
    }

    public function WorkHours()
    {
        $user = Auth::user();
        // dd( $user->id);
        $WorkHours = WorkHours::where('user_id', '=', $user->id)->get();

        dd($WorkHours);
        return view('Pages.user.profile', compact('user'));
    }
    public function WorkHoursUser(Request $request)
    {
        $id = 186;

        // dd( $user->id);
        $year = 2022;
        $date_from = $year . '-1-1';
        $date_to = $year . '-12-31';
        $from = date($date_from);
        $to = date($date_to);
        $WorkHours = WorkHours::where('user_id', '=', $id)->get();
        dd($WorkHours);

        $WorkHours = WorkHours::where('user_id', '=', $id)->whereBetween('date', [$from, $to])->get();
        // dd(  $WorkHours);

        return view('Pages.user.profile', compact('user'));
    }
    public function userprofile()
    {

        $user = Auth::user();
        if ($user == null) {
            return Redirect::to("/Admin");
        }
        return view('Pages.userProfileN.userProfilePage', compact('user'));
    }
    public function updateuser(Request $request)
    {

        $user = User::findOrFail(Auth::id());
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|digits_between:10,14',
            'password' => [new passwordRule($user->password)],
            'Confirm_password' => 'same:new_password'

            // 'email'=>['required', new passwordRule]
        ], [
            'name.required' => 'الرجاء ادخال اسم',
            'name.string' => 'الاسم يجب ان يكون احرف فقط',
            'name.min' => 'الاسم يجب ان يكون على الاقل 3 حروف',
            'name.max' => 'الاسم لا يجب ان يكون فوق ال 255 حرف',
            'email.required' => 'الرجاء ادخال ايميل',
            'email.email' => "يجب ان يكون الايميل صحيح",
            'email.unique' => 'يجب ان يكون الايميل غير مكرر',
            'phone.required' => 'ارجاء ادخال رقم الهاتف',
            'phone.digits_between' => 'الرجاء ادخال رقم الهاتف بشكل صحيح. ',
            'Confirm_password.same' => "كلمة السر الجديده غير متطابقة"




        ]);
        // dd( $request->all());


        $user->update([
            'id_number' => $request->id_number,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'start_work_date' => $request->start_work_date,
            'city' => $request->city,
            'job' => $request->job,
            'martial_status' => $request->martial_status,
            'bank_name' => $request->bank_name,
            'bank_number' => $request->bank_number,
            'bank_branch' => $request->bank_branch,
            'account_number' => $request->account_number,

        ]);

        if ($request->photo) {
            $user->photo = $request->photo->store('images', 'public');
        }
        if ($request->password) {

            if ((Hash::check($request->password, $user->password))) {

                if ($request->new_password == $request->Confirm_password)

                    $user->password = Hash::make($request->new_password);
            }
        }
        if ($request->image) {
            $user->photo = $request->image->store('images', 'public');
        }
        // dd($user);

        $user->save();

        return redirect('Admin/userprofile')->with('changes_success', 'success');
    }
    public function updatepersonaldata(Request $request)
    {


        $user = User::findOrFail(Auth::id());
        $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|digits_between:10,14',


            // 'email'=>['required', new passwordRule]
        ], [
            'name.required' => 'الرجاء ادخال اسم',
            'name.string' => 'الاسم يجب ان يكون احرف فقط',
            'name.min' => 'الاسم يجب ان يكون على الاقل 3 حروف',
            'name.max' => 'الاسم لا يجب ان يكون فوق ال 255 حرف',
            'email.required' => 'الرجاء ادخال ايميل',
            'email.email' => "يجب ان يكون الايميل صحيح",
            'email.unique' => 'يجب ان يكون الايميل غير مكرر',
            'phone.required' => 'ارجاء ادخال رقم الهاتف',
            'phone.digits_between' => 'الرجاء ادخال رقم الهاتف بشكل صحيح. ',
        ]);
        // dd( $request->all());


        $user->update([
            'name' => $request->name,
            'job' => $request->job,
            'email' => $request->email,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'id_number' => $request->id_number,
            'start_work_date' => $request->start_work_date,
            'city' => $request->city,
            'martial_status' => $request->martial_status,
            // 'bank_name' => $request->bank_name,
            // 'bank_number' => $request->bank_number,
            // 'bank_branch' => $request->bank_branch,
            // 'account_number' => $request->account_number,

        ]);

        if ($request->photo) {
            $user->photo = $request->photo->store('images', 'public');
        }
        // if ($request->password) {

        //    if((Hash::check($request->password, $user->password)))
        //    {

        //     if($request->new_password==$request->Confirm_password)

        //     $user->password = Hash::make($request->new_password);
        //    }
        // }
        if ($request->image) {
            $user->photo = $request->image->store('images', 'public');
        }
        // dd($user);

        $user->save();

        return redirect('Admin/userprofile')->with('changes_success', 'success');
    }
    public function updatebankdata(Request $request)
    {

        $user = User::findOrFail(Auth::id());

        $user->update([

            'bank_name' => $request->bank_name,
            'bank_number' => $request->bank_number,
            'bank_branch' => $request->bank_branch,
            'account_number' => $request->account_number,

        ]);



        $user->save();

        return redirect('Admin/userprofile')->with('changes_success', 'success');
    }
    public function updatepassword(Request $request)
    {

        $user = User::findOrFail(Auth::id());
        $request->validate([
            'old_password' => [new passwordRule($user->password)],
            'Confirm_password' => 'same:new_password'
        ], [

            'Confirm_password.same' => "كلمة السر الجديده غير متطابقة"

        ]);
        // dd( $request->all());


        if ($request->old_password) {

            if ((Hash::check($request->old_password, $user->password))) {

                if ($request->new_password == $request->Confirm_password)

                    $user->password = Hash::make($request->new_password);
            }
        }



        $user->save();

        return redirect('Admin/userprofile')->with('changes_success', 'success');
    }
    public function user()
    {
        return Auth::user();
    }
    public function Admin()
    {

        $user =  Auth::user();

        if ((in_array('super-admin',   $user->userrole()))) {
            return true;
        } else {
            return false;
        }
    }
    public function users()
    {
        return User::all();
    }
    public function first(Request $request)
    {
        $projects = Project::where('sector', '=', $request->project_id)->get();
        return $projects;
    }
    public function save(Request $request)
    {

        if ($request->budgetsOfyear) {
            DB::table('budgets')
                ->updateOrInsert(
                    ['year' => $request->year, 'sector_id' =>  0],
                    ['budget' => $request->budgetsOfyear]

                );

            $year = $request->year;
            $firstDayOfYear = Carbon::createFromDate($year, 1, 1)->startOfDay();
            $existingProjects = Project::where('project_name', 'حصلات ' . $request->year)->get();
            if ($existingProjects->isEmpty()) {
                $project = new Project();
                $project->project_type = 1;
                $project->project_name = 'حصلات ' . $request->year;
                $project->project_describe = 'حصلات ' . $request->year;
                $project->sector = 11;
                $project->start_date = $firstDayOfYear;

                $project->save();
            }
        }


        foreach ($request->Sectors as $key => $value) {
            DB::table('budgets')
                ->updateOrInsert(
                    ['year' => $request->year, 'sector_id' =>  $value['sector_id']],
                    ['budget' => $value['Budget'] ?? 0]

                );
        }
    }
    public function delet(Request $request)
    {

        Budget::where('year', $request->year)->forceDelete();
    }
    public function SendMessage(Request $request)
    {
        $TelephoneDirectory = TelephoneDirectory::query();

        $TelephoneDirectory->where(function ($query) use ($request) {
            foreach ($request->type as $type) {
                $query->orWhereJsonContains('type', $type);
            }
        });
        $results = $TelephoneDirectory->get();
        foreach ($results as $key => $value) {
            $phoneNumber = $value->phone_number;
            if (preg_match('/^\d{10}$/', $phoneNumber)) {
                Http::get('https://la.cellactpro.com/http_req.asp', [
                    'FROM' => 'ppAksa',
                    'USER' => 'ppAksa',
                    'PASSWORD' => 'UKFV6Sx7',
                    'APP' => 'LA',
                    'CMD' => 'sendtextmt',
                    'CONTENT' => $request->Message,
                    'SENDER' => '0506940095',
                    'TO' => $value->phone_number,
                ]);
            }
        }
        ArchiveSms::create([
            'send_type' => json_encode($request->type),
            'content' => $request->Message,
            'date' => Carbon::now(),
            'number_of_people' => $results->count(),
            'sender_id' => Auth::id(),
        ]);

        return response()->json(['message' => 'Message Sent successfully.'], 200);
    }

    public function SectorsBudget(Request $request)
    {

        $sector = array();
        $Sectors = Sector::all();
        $Budgets = Budget::where([
            ['year', '=', $request->year],
            ['sector_id', '=', 0],
        ])->first();
        $pus = array(
            "sector_id" => 0,
            "Sector" => "ميزانية السنة",
            "Budget" => $Budgets->budget
        );
        array_push($sector, $pus);

        foreach ($Sectors as $key => $Sector) {
            $Budgets = Budget::where([
                ['year', '=', $request->year],
                ['sector_id', '=', $Sector->id],
            ])->first();

            // echo ( ! empty ( $Budgets ));


            if (!empty($Budgets)) {

                $pus = array(
                    "sector_id" => $Sector->id,
                    "Sector" => $Sector->text,
                    "Budget" => $Budgets->budget
                );
            } else {
                $pus = array(
                    "sector_id" => $Sector->id,
                    "Sector" => $Sector->text,
                    "Budget" => '0'
                );
            }
            array_push($sector, $pus);
        }
        return $sector;
    }

    public function contactus()
    {
        $type = 2;
        return view('Pages.contact-page', compact('type'));
    }

    public function contactusDonation()
    {
        $type = 1;
        return view('Pages.contact-page', compact('type'));
    }
    public function SectorYearstatistics(Request $request)
    {
        $Budgets = Budget::where([
            ['year', '=', $request->year],
            ['sector_id', '=', '0'],
        ])->first();

        $year = $request->year;
        $date_from = $year . '-1-1';
        $date_to = $year . '-12-31';
        $from = date($date_from);
        $to = date($date_to);

        $sector = array();
        $expenses_allyear = Transaction::where('main_type', '2')->whereBetween('transaction_date', [$from, $to])->sum('equivelant_amount');
        $income_allyear = Transaction::where('main_type', '1')->whereBetween('transaction_date', [$from, $to])->sum('equivelant_amount');

        $sector = array(
            "Budgets" => (int) $Budgets->budget,
            "expenses_year" => (int) $expenses_allyear,
            "income_year" => (int)$income_allyear,


        );
        return $sector;
    }
    public function Sectorstatistics(Request $request)
    {

        $sector = array();
        $sectoryear = $request->year; // Replace with the actual year you want to filter

        $Sectors = Sector::whereHas('budget', function ($query) use ($sectoryear) {
            $query->where('year', '=', $sectoryear)
                ->where('budget', '>', 0);
        })->orWhereIn('id', [7, 11])->get();

        foreach ($Sectors as $key => $Sector) {
            $Budgets = Budget::where([
                ['year', '=', $request->year],
                ['sector_id', '=', $Sector->id],
            ])->first();

            $year = $request->year;
            //years
            $expenses_year = 0;
            $income_year = 0;
            $date_from = $year . '-1-1';
            $date_to = $year . '-12-31';
            $from = date($date_from);
            $to = date($date_to);
            $Transactions = Transaction::where('main_type', '2')->where('sector', $Sector->id)->whereBetween('transaction_date', [$from, $to])->get();
            $Transactionsincome = Transaction::where('main_type', '1')->where('sector', $Sector->id)->whereBetween('transaction_date', [$from, $to])->get();

            foreach ($Transactions as $key => $Transaction) {
                $expenses_year += $Transaction->equivelant_amount;
            }
            $expenses_year = number_format($expenses_year, 2, '.', '');
            foreach ($Transactionsincome as $key => $Transaction) {
                $income_year += $Transaction->equivelant_amount;
            }
            $income_year = number_format($income_year, 2, '.', '');

            //First Quarter
            $expenses_First = 0;
            $income_First = 0;
            $date_from = $year . '-1-1';
            $date_to = $year . '-3-31';
            $from = date($date_from);
            $to = date($date_to);
            $Transactions = Transaction::where('main_type', '2')->where('sector', $Sector->id)->whereBetween('transaction_date', [$from, $to])->get();
            $Transactionsincome = Transaction::where('main_type', '1')->where('sector', $Sector->id)->whereBetween('transaction_date', [$from, $to])->get();

            foreach ($Transactions as $key => $Transaction) {
                $expenses_First += $Transaction->equivelant_amount;
            }
            $expenses_First = number_format($expenses_First, 2, '.', '');
            foreach ($Transactionsincome as $key => $Transaction) {
                $income_First += $Transaction->equivelant_amount;
            }
            $income_First = number_format($income_First, 2, '.', '');
            //Second Quarter
            $expenses_Second = 0;
            $income_Second = 0;
            $date_from = $year . '-4-1';
            $date_to = $year . '-6-30';
            $from = date($date_from);
            $to = date($date_to);
            $Transactions = Transaction::where('main_type', '2')->where('sector', $Sector->id)->whereBetween('transaction_date', [$from, $to])->get();
            $Transactionsincome = Transaction::where('main_type', '1')->where('sector', $Sector->id)->whereBetween('transaction_date', [$from, $to])->get();

            foreach ($Transactions as $key => $Transaction) {
                $expenses_Second += $Transaction->equivelant_amount;
            }
            $expenses_Second = number_format($expenses_Second, 2, '.', '');
            foreach ($Transactionsincome as $key => $Transaction) {
                $income_Second += $Transaction->equivelant_amount;
            }
            $income_Second = number_format($income_Second, 2, '.', '');

            //Third Quarter
            $expenses_Third = 0;
            $income_Third = 0;
            $date_from = $year . '-7-1';
            $date_to = $year . '-9-30';
            $from = date($date_from);
            $to = date($date_to);
            $Transactions = Transaction::where('main_type', '2')->where('sector', $Sector->id)->whereBetween('transaction_date', [$from, $to])->get();
            $Transactionsincome = Transaction::where('main_type', '1')->where('sector', $Sector->id)->whereBetween('transaction_date', [$from, $to])->get();

            foreach ($Transactions as $key => $Transaction) {
                $expenses_Third += $Transaction->equivelant_amount;
            }
            $expenses_Third = number_format($expenses_Third, 2, '.', '');
            foreach ($Transactionsincome as $key => $Transaction) {
                $income_Third += $Transaction->equivelant_amount;
            }
            $income_Third = number_format($income_Third, 2, '.', '');

            //fourth Quarter
            $expenses_fourth = 0;
            $income_fourth = 0;
            $date_from = $year . '-10-1';
            $date_to = $year . '-12-31';
            $from = date($date_from);
            $to = date($date_to);
            $Transactions = Transaction::where('main_type', '2')->where('sector', $Sector->id)->whereBetween('transaction_date', [$from, $to])->get();
            $Transactionsincome = Transaction::where('main_type', '1')->where('sector', $Sector->id)->whereBetween('transaction_date', [$from, $to])->get();

            foreach ($Transactions as $key => $Transaction) {
                $expenses_fourth += $Transaction->equivelant_amount;
            }
            $expenses_fourth = number_format($expenses_fourth, 2, '.', '');
            foreach ($Transactionsincome as $key => $Transaction) {
                $income_fourth += $Transaction->equivelant_amount;
            }
            $income_fourth = number_format($income_fourth, 2, '.', '');



            if (!empty($Budgets)) {

                $pus = array(
                    "sector_id" => $Sector->id,
                    "Sector" => $Sector->text,
                    "Budget" => (int) $Budgets->budget,
                    "expenses_year" => (int) $expenses_year,
                    "expenses_First" => (int)$expenses_First,
                    "expenses_Second" => (int)  $expenses_Second,
                    "expenses_Third" => (int)  $expenses_Third,
                    "expenses_fourth" => (int) $expenses_fourth,
                    "income_year" => (int) $income_year,
                    "income_First" => (int) $income_First,
                    "income_Second" => (int) $income_Second,
                    "income_Third" => (int)$income_Third,
                    "income_fourth" => (int)$income_fourth,




                );
            } else {
                $pus = array(
                    "sector_id" => $Sector->id,
                    "Sector" => $Sector->text,
                    "Budget" => '0',

                    "expenses_year" => (int) $expenses_year,
                    "expenses_First" => (int)$expenses_First,
                    "expenses_Second" => (int) $expenses_Second,
                    "expenses_Third" => (int) $expenses_Third,
                    "expenses_fourth" => (int) $expenses_fourth,

                    "income_year" => (int)$income_year,
                    "income_First" => (int)$income_First,
                    "income_Second" => (int)$income_Second,
                    "income_Third" => (int) $income_Third,
                    "income_fourth" => (int)$income_fourth,

                );
            }
            array_push($sector, $pus);
        }
        return $sector;
    }


    public function getSectors(Request $request)
    {
        $Sectors = Sector::whereHas('budget', function ($query) use ($request) {
            $query->where('year', '=', $request->Year)
                ->where('budget', '>', 0);
        })->orWhereIn('id', [7, 11])->get();

        return $Sectors;
    }
    public function getProject(Request $request)
    {
        $Sectors =  Sector::whereHas('budget', function ($query) use ($request) {
            $query->where('year', '=', $request->Year)
                ->where('budget', '>', 0);
        })->pluck('id')->toArray();

        $projects = project::whereIn('sector', $Sectors)->get();
        return $projects;
    }

    public function getBus(Request $request)
    {

        $busarray = array();
        $projext = Project::where('id', $request->id)->with('bus')->first();

        if (isset($projext)) {


            $text = '';
            $buss = $projext->bus;
            foreach ($buss as $key => $bus) {
                $number_of_people = TripBooking::where([
                    ['bus_id', $bus->id],
                    ['status', '1'],
                ])->sum('number_of_people');

                $pus = array(
                    "bus_number" => $bus->bus_number,
                    "number_of_seats" => $bus->number_of_seats,
                    "number_of_people" => ($bus->number_of_seats - $number_of_people),
                );

                array_push($busarray, $pus);
            }
        }


        return $busarray;
    }
    public function Sectors(Request $request)
    {

        $sector = array();
        $Sectors = Sector::where('in_budget', 1)->get();
        foreach ($Sectors as $key => $Sector) {





            $pus = array(
                "sector_id" => $Sector->id,
                "Sector" => $Sector->text,
                "Budget" => '0'
            );


            array_push($sector, $pus);
        }
        // dd($sector);
        return $sector;
    }
    public function getType(Request $request)
    {

        $TypeArray = array();
        $Types = SmsType::all();
        foreach ($Types as $key => $Type) {


            $pus = array(
                "id" => $Type->id,
                "name" => $Type->name,
            );


            array_push($TypeArray, $pus);
        }
        return $TypeArray;
    }

    public function SectorsPill(Request $request)
    {

        $sector = array();
        $Sectors = Sector::all();
        foreach ($Sectors as $key => $Sector) {





            $pus = array(
                "sector_id" => $Sector->id,
                "Sector" => $Sector->text,
            );


            array_push($sector, $pus);
        }

        return $sector;
    }
    public function year()
    {
        $years = Budget::select('year')->get()->unique('year');
        return  $years;
    }
    public function DeleteYears()
    {
        $years = Budget::onlyTrashed()->select('year')->get()->unique('year');

        return  $years;
    }
    public function Recovery(Request $request)
    {

        Budget::where('year', $request->year)->restore();
    }
    public function originalbillbills($id, $type = 1)
    {
        $Transaction = Transaction::where('id', $id)
            ->with(['Sectors', 'Project', 'Alhisalat', 'TelephoneDirectory'])
            ->first();

        $PaymentType = $this->getPaymentType($Transaction->Payment_type, $Transaction->lang);
        $original = 1;
        $type = ($Transaction->is_delete == 2) ? '2' : '1';



        return view('Pages.Bills.Bills', compact('Transaction', 'original', 'PaymentType', 'type'));
    }

    private function getPaymentType($paymentType, $lang)
    {
        $paymentTypes = [
            1 => ['نقدي', 'cash', 'כסף מזומן'],
            2 => ['شك', 'Bank doubt', 'ספק בבנק'],
            3 => ['بيت', 'bit', 'קצת'],
            4 => ['حوالة مصرفية', 'Bank transfer', 'העברה בנקאית'],
            5 => ['حصالة', 'moneybox', 'קופסת כסף'],
            6 => ['التطبيق', 'Application', 'יישום'],
        ];

        return $paymentTypes[$paymentType][$lang - 1] ?? null;
    }


    public function bills($id, $type = 1)
    {
        $Transaction =  Transaction::where("id", $id)->with('Sectors')->with('Project')->with('TelephoneDirectory')->first();
        // dd($Transaction );
        if ($Transaction->lang == 1) {
            switch ($Transaction->Payment_type) {
                case 1:
                    $PaymentType = "نقدي";
                    break;
                case 2:
                    $PaymentType = "شك";
                    break;
                case 3:
                    $PaymentType = "بيت";
                    break;
                case 4:
                    $PaymentType = "حوالة مصرفية";
                    break;
                case 5:
                    $PaymentType = "حصالة";
                    break;
                case 6:
                    $PaymentType = "التطبيق";
                    break;
            }
        } else if ($Transaction->lang == 2) {
            switch ($Transaction->Payment_type) {
                case 1:
                    $PaymentType = "cash";
                    break;
                case 2:
                    $PaymentType = "Bank doubt";
                    break;
                case 3:
                    $PaymentType = "bit";
                    break;
                case 4:
                    $PaymentType = "Bank transfer";
                    break;
                case 5:
                    $PaymentType = "moneybox";
                    break;
                case 6:
                    $PaymentType = "Application";
                    break;
            }
        } else if ($Transaction->lang == 3) {
            switch ($Transaction->Payment_type) {
                case 1:
                    $PaymentType = "כסף מזומן";
                    break;
                case 2:
                    $PaymentType = "ספק בבנק";
                    break;
                case 3:
                    $PaymentType = "קצת";
                    break;
                case 4:
                    $PaymentType = "העברה בנקאית";
                    break;
                case 5:
                    $PaymentType = "קופסת כסף";
                    break;
                case 6:
                    $PaymentType = "יישום";
                    break;
            }
        }

        // dd($sector_Text);
        $original = 0;
        $type = ($Transaction->is_delete == 2) ? '2' : '1';


        return view('Pages.Bills.Bills', compact('Transaction', 'original',  'PaymentType', 'type'));
    }
    public function mainbill($id, Request $request)
    {
        $typeBill = $request->type;
        $transaction = Transaction::where("id", $id)
            ->with('Sectors')
            ->with('Project')
            ->with('TelephoneDirectory')
            ->first();
        $paymentTypes = [
            1 => ["نقدي", "cash", "כסף מזומן"],
            2 => ["شك", "Bank doubt", "ספק בבנק"],
            3 => ["بيت", "bit", "קצת"],
            4 => ["حوالة مصرفية", "Bank transfer", "העברה בנקאית"],
            5 => ["حصالة", "moneybox", "קופסת כסף"],
            6 => ["حصالة", "moneybox", "קופסת כסף"],
        ];

        $langIndex = $transaction->lang - 1; // Assuming lang is 1, 2, or 3
        $paymentType = $paymentTypes[$transaction->Payment_type][$langIndex] ?? 'Unknown';

        $original = 0;
        $type = ($request->type == 'repayment') ? '2' : '1';
        $bill_number = $transaction->bill_number;
        return view('Pages.Bills.mainBill', compact('id', 'type', 'bill_number'));
    }

    public function SendMail(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'Mail' => 'required|email|',


            ],
            [
                'Mail.email' => "يجب ان يكون الايميل صحيح",
                'Mail.required' => "الرجاء ادخال الايميل المراد ارسال الملف له",


            ]
        );
        if ($validator->passes()) {
            $Transaction =  Transaction::where("id", $request->id)->with('Sectors')->with('Project')->with('TelephoneDirectory')->first();

            if ($Transaction->lang == 1) {
                switch ($Transaction->Payment_type) {
                    case 1:
                        $PaymentType = "نقدي";
                        break;
                    case 2:
                        $PaymentType = "شك";
                        break;
                    case 3:
                        $PaymentType = "بيت";
                        break;
                    case 4:
                        $PaymentType = "حوالة مصرفية";
                        break;
                    case 5:
                        $PaymentType = "حصالة";
                        break;
                }
            } else if ($Transaction->lang == 2) {
                switch ($Transaction->Payment_type) {
                    case 1:
                        $PaymentType = "cash";
                        break;
                    case 2:
                        $PaymentType = "Bank doubt";
                        break;
                    case 3:
                        $PaymentType = "bit";
                        break;
                    case 4:
                        $PaymentType = "Bank transfer";
                        break;
                    case 5:
                        $PaymentType = "moneybox";
                        break;
                }
            } else if ($Transaction->lang == 3) {
                switch ($Transaction->Payment_type) {
                    case 1:
                        $PaymentType = "כסף מזומן";
                        break;
                    case 2:
                        $PaymentType = "ספק בבנק";
                        break;
                    case 3:
                        $PaymentType = "קצת";
                        break;
                    case 4:
                        $PaymentType = "העברה בנקאית";
                        break;
                    case 5:
                        $PaymentType = "קופסת כסף";
                        break;
                }
            }

            Mail::to($request->Mail)->send(new \App\Mail\BillMail($Transaction, $PaymentType));
            return response()->json(['success' => 'send maill.']);
        }
        return $this->sendError('Error', ["message" => $validator->errors()->all()], 404);
    }
    public function showToastrMessages()
    {

        // Flash messages settings

        session()->flash("success", "This is success message");

        session()->flash("warning", "This is warning message");

        session()->flash("info", "This is information message");

        session()->flash("error", "This is error message");

        return view("toastr-notification");
    }

    public function index()
    {

        $Heros = nova_get_setting('heroo', 'default_value');


        $lastnews = DB::table('news')->orderBy('new_date', 'desc')->take(2)->get();

        $news = DB::table('news')->orderBy('new_date', 'desc')->take(9)->get();

        $ProjectsNews = nova_get_setting('Projects_News', 'default_value');
        // $ProjectsNews = json_decode($ProjectsNewsjson);

        $partners = nova_get_setting('partner', 'default_value');
        // $partners = json_decode($partnerjson);
        $sectors = Sector::where('is_published', 1)->get();
        // $sectors = nova_get_setting('workplace', 'default_value');
        $type = 2;
        // $sectors= json_decode($sectorsjson);

        return view('Pages.home', compact('Heros', 'lastnews', 'news', 'ProjectsNews', 'partners', 'sectors', 'type'));
    }
    public function aboutus()
    {
        $goalsjson = nova_get_setting('goals', 'default_value');
        $goals = json_decode($goalsjson);
        $achievementsjson = nova_get_setting('achievements', 'default_value');
        $achievements = json_decode($achievementsjson);
        $workplace = nova_get_setting('workplace', 'default_value');
        $sectors =  Sector::where('is_published', 1)->get();

        $type = 2;
        return view('Pages.about-us-page', compact('goals', 'achievements', 'workplace', 'type', 'sectors'));
    }

    public function conctus(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|min:3|max:50',
                'phone' => 'digits_between:10,14',
                'message' => 'required',
            ],
            [
                'name.required' => 'الرجاء ادخال الاسم. ',
                'name.string' => 'الرجاء ادخال الاسم بشكل صحيح . ',
                'name.min' => 'الاسم يجب ان يكون على الأقل 3 حروف. ',
                'name.max' => 'الاسم يجب ان لا يزيد عن 50 حرف. ',

                'phone.digits_between' => 'الرجاء ادخال رقم الهاتف بشكل صحيح. ',
                'message.required' => 'الرجاء ادخال الرسالة. ',
            ]
        );
        if ($validator->passes()) {
            FormMassage::create([
                'name' => $request['name'],
                'phone' => $request['phone'],
                'message' => $request['message'],
                'type' => '0',

            ]);
            return response()->json(['success' => 'Added new records.']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }

    public function Almuahada(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|min:3|max:50',
                'phone' => 'digits_between:10,14',
                'city' => 'required',
            ],
            [
                'name.required' => 'الرجاء ادخال الاسم. ',
                'name.string' => 'الرجاء ادخال الاسم بشكل صحيح . ',
                'name.min' => 'الاسم يجب ان يكون على الأقل 3 حروف. ',
                'name.max' => 'الاسم يجب ان لا يزيد عن 50 حرف. ',

                'phone.digits_between' => 'الرجاء ادخال رقم الهاتف بشكل صحيح. ',
                'city.required' => 'الرجاء ادخال المدينة. ',
            ]
        );
        if ($validator->passes()) {
            Almuahada::create([
                'name' => $request['name'],
                'phone' => $request['phone'],
                'city' => $request['city'],

            ]);
            return response()->json(['success' => 'Added new records.']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }


    public function news($maintype, $type)
    {
        $main_type = newsType::where('name', $maintype)
            ->where('type', '0')
            ->select('main_type')->first();

        $Type = newsType::where('name', $type)
            ->where('main_type', $main_type->main_type)
            ->select('type')->first();

        $news = DB::table('news')->where([
            ['main_type', 'like', '%' . $main_type->main_type . '%'],
            ['type', '=', $Type->type],
            ['status', '=', '1']
        ])->orderBy('new_date', 'desc')->paginate(9);



        $mainType = str_replace("-", " ", $maintype);
        $type = str_replace("-", " ", $type);
        return view('Pages.news-page', compact('news', 'mainType', 'type'));
    }

    public function getnewDetail($title, $id)
    {

        $new = DB::table('news')->where('id', $id)->first();

        $Articles = DB::table('news')->where([
            ['type', '=', $new->type],
            ['main_type', '=', $new->main_type],
        ])->orderBy('new_date', 'desc')->take(6)->get();
        // dd(  $Articles);
        $goalsjson = $new->pictures;

        $pictures = json_decode(json_decode($goalsjson, true), true);

        $total =  json_decode(json_decode($new->main_type, true), true);
        gettype($total);
        if (gettype($total) == "string") {
            $tt =  str_replace('"', "", $total);

            $mainType = DB::table('news_types')->where([
                ['main_type', 'like',  $tt],
                ['type', '=', '0'],
            ])->first();

            $mainType =  $mainType->name;
            //  dd(   $mainType);
        } else $mainType = "اخبار";

        return view('Pages.news-details-page', compact('new', 'pictures', 'Articles', 'mainType'));
    }

    public function library()
    {
        $books = Book::where('post', 1)->get();
        $book_type = BookType::all();
        return view('Pages.Library.Library', compact('books', 'book_type'));
    }
    public function libraryDetail($id)
    {

        $book = Book::where('id', $id)->first();
        $book_type = Book::where('type',  $book->type)->whereNotIn('id', [$id])->take(6)->get();

        return view('Pages.Library.libraryDetail', compact('book', 'book_type'));
    }

    public function librarySearch($search)
    {
        $books = Book::where('name', 'like',  "%{$search}%")->orWhere('author', 'like',  "%{$search}%")

            ->get();
        return $books;
    }

    public function librarySearchType($id)
    {
        $type = BookType::where('id', $id)->first();
        $books = Book::where('type',  $type->id)->get();

        return  $books;
    }

    public function sector($sector)
    {
        // dd($sector);
        $mainType = "قطاع";
        $sectorname = Sector::find($sector);
        $type = $sectorname->text;
        // dd($type);

        $news = News::query()->where('sector', $sector)->orderBy('new_date', 'desc')

            ->paginate(9);
        // dd($news);

        return view('Pages.news-page', compact('news', 'mainType', 'type'));
        // foreach ($News as $key => $value) {
        //     echo  $value->title;
        //     echo '<br>';
        // }
        // dd ($News);
        // return dd($News);
    }
    public function qawafel()
    {
        // dd($sector);mainType
        $mainType = "قوافل الاقصي";
        $type = "اخبار";
        $projects = Project::where([
            ['project_type', '=', '2'],
            ['report_status', '=', '1'],
        ])->paginate(9);
        // $news = News::query()->where('sector', $sector)

        //     ->paginate(9);
        return view('Pages.ProjectsDetails.projects-page', compact('projects'));

        // foreach ($News as $key => $value) {
        //     echo  $value->title;
        //     echo '<br>';
        // }
        // dd ($News);
        // return dd($News);
    }
    public function search($search)
    {

        $main_type = newsType::where('name', 'like',  "%{$search}%")
            ->select('main_type')
            ->get();

        // dd( $main_type[0]->type);

        $stack_main_type = array();
        foreach ($main_type as $key => $value) {
            array_push($stack_main_type, $value->main_type);
        }

        $News = News::query()
            ->wherein('type', $stack_main_type)
            ->orWhere('title', 'like',  "%{$search}%")
            ->orWhere('sector', 'like',  "%{$search}%")
            ->select('title', 'id')
            ->get();

        return $News;
    }

    public function pagesearch(Request $request)
    {

        $search = $request->get("search");
        $type = $request->get("search");
        $mainType = "بحث";
        $main_type = newsType::where('name', 'like',  '%' . $search . '%')
            ->select('main_type')->get();



        $stack_main_type = array();
        foreach ($main_type as $key => $value) {
            array_push($stack_main_type, $value->main_type);
        }

        $news = News::query()
            ->wherein('type', $stack_main_type)
            ->orWhere('title', 'like',  "%{$search}%")
            ->orWhere('sector', 'like',  "%{$search}%")
            ->paginate(9);
        return view('Pages.news-page', compact('news', 'mainType', 'type'));
    }
    public function projectdonation()
    {
        $Projects = DB::table('projects')->where([
            ['is_donation', '=', '1'],
            ['report_status', '=', '1'],
        ])
            ->get();


        // dd($Projects);
        return view('Pages.projectDonations.projects-donation', compact('Projects'));
    }
    public function getdonationDetail($id)
    {

        $project = DB::table('projects')->where('id', $id)->first();

        $goalsjson = $project->report_pictures;

        $pictures = json_decode($goalsjson, true);






        return view('Pages.projectDonations.project-donation-details', compact('project', 'pictures'));
    }


    public function project()
    {

        $projects = DB::table('projects')->where('report_status', '=', '1')->orderBy('report_date', 'desc')->paginate(9);
        return view('Pages.ProjectsDetails.projects-page', compact('projects'));
    }
    public function     getprojectDetailapi($id)
    {
        $project = DB::table('projects')->where('id', $id)->first();
        $goalsjson = $project->report_pictures;

        $pictures = json_decode($goalsjson, true);

        $Articles = DB::table('projects')->orderBy('report_date', 'desc')->take(6)->get();
        return         $project;
        // return view('Pages.ProjectsDetails.project-details-page', compact('project', 'pictures', 'Articles'));
    }
    public function     getprojectDetail($id)
    {
        $project = DB::table('projects')->where('id', $id)->first();

        $goalsjson = $project->report_pictures;

        $pictures = json_decode($goalsjson, true);

        $Articles = DB::table('projects')->orderBy('report_date', 'desc')->take(6)->get();

        return view('Pages.ProjectsDetails.project-details-page', compact('project', 'pictures', 'Articles'));
    }
    public function  donation($id)
    {
        $project = DB::table('projects')->where('id', $id)->first();
        return view('Pages.donationsPage.donations-page', compact('project'));
    }
    public function donations()
    {
        $project = null;
        return view('Pages.donationsPage.donations-page', compact('project'));
    }
    public function donationsApi(Request $request)
    {

        $page_size = isset($request->perPage) ? $request->perPage : 10;

        $decodedString = base64_decode($request->input('filters'));
        $array = json_decode($decodedString, true);



        $transactions = Transaction::where([
            ['main_type', 1],
            ['type', 2],
            ['is_delete', '<>', 2],
        ])->orderBy('created_at', 'desc');
        if (is_array($array)) {
            foreach ($array as $item) {
                if (!empty($item['value'])) {
                    switch ($item['class']) {
                        case 'App\Nova\Filters\AlhisalatColect':
                            switch ($item['value']) {
                                case __('الكل'):
                                    $transactions = $transactions;
                                    break;
                                case __('Not Receive yet'):
                                    $transactions = $transactions->where('transaction_status', '=', 1);
                                    break;
                                case __('in a box'):
                                    $transactions = $transactions->where('transaction_status', '=', 2);
                                    break;

                                case __('in the bank'):
                                    $transactions = $transactions->where('transaction_status', '=', 3);
                                    break;

                                default:
                                    break;
                            }
                            break;
                        case 'App\Nova\Filters\Transactionproject':
                            $Project = Project::where('project_name', $item['value'])->first();
                            if ($Project) {
                                $transactions->where('ref_id', $Project->id);
                            }
                            break;
                        case 'App\Nova\Filters\TransactionSectors':
                            $Sector = Sector::where('text', $item['value'])->first();
                            if ($Sector) {
                                $transactions->where('sector', $Sector->id);
                            }
                            break;
                        case 'App\Nova\Filters\PaymentType':
                            switch ($item['value']) {
                                case __('الكل'):
                                    $transactions = $transactions;
                                    break;
                                case __('cash'):
                                    $transactions = $transactions->where('Payment_type', '=', 1);
                                    break;
                                case __('shek'):
                                    $transactions = $transactions->where('Payment_type', '=', 2);
                                    break;
                                case __('bit'):
                                    $transactions = $transactions->where('Payment_type', '=', 3);
                                    break;
                                case __('hawale'):
                                    $transactions = $transactions->where('Payment_type', '=', 4);
                                    break;
                                case __('حصالة'):
                                    $transactions = $transactions->where('Payment_type', '=', 5);
                                    break;
                                default:
                                    break;
                            }
                            break;
                        case 'App\Nova\Filters\ReportCreated':
                            $user = User::where('name',  $item['value'])->first();
                            if ($user) {
                                $transactions->where('Created_By', $user->id);
                            }

                            break;
                        case 'App\Nova\Filters\ReportCompany':
                            $Company = TelephoneDirectory::where('name', $item['value'])->first();
                            if ($Company) {
                                $transactions->where('name', $Company->id);;
                            }

                            break;
                        case 'PosLifestyle\DateRangeFilter\DateRangeFilter_transaction_date':
                            if (isset($item['value'][0], $item['value'][1])) {

                                $transactions->whereBetween(
                                    'transaction_date',
                                    [
                                        Carbon::createFromFormat('Y-m-d', $item['value'][0])->startOfDay(),
                                        Carbon::createFromFormat('Y-m-d', $item['value'][1])->endOfDay(),
                                    ]
                                );
                            }
                            break;
                        default:
                            break;
                    }
                }
            }
        }
        $transactions = $transactions->paginate($page_size);
        $statuses = [
            '1' => __('Not Receive yet'),
            '2' => __('in a box'),
            '3' => __('in the bank'),
        ];
        $PaymentType = [
            '1' => __('cash'),
            '2' => __('shek'),
            '3' => __('bit'),
            '4' => __('hawale'),
            '5' => __('حصالة'),
            '6' => __('التطبيق'),

        ];
        $resources = $transactions->map(function ($transaction) use ($statuses, $PaymentType) {
            return [
                'actions' => [
                    [
                        "cancelButtonText" => "إلغاء",
                        "component" => "confirm-action-modal",
                        "confirmButtonText" => "تنفيذ الاجراء",
                        "class" => "btn-primary",
                        "confirmText" => "هل أنت متأكد من تنفيذ هذا الاجراء؟",
                        "destructive" => false,
                        "name" => "تعويض",
                        "uriKey" => "تعويض",
                        "fields" => [
                            [
                                "attribute" => "transaction_date",
                                "component" => "date",
                                "helpText" => null,
                                "indexName" => "تاريخ ",
                                "name" => "تاريخ ",
                                "nullable" => false,
                                "panel" => null,
                                "prefixComponent" => true,
                                "readonly" => false,
                                "required" => true,
                                "sortable" => false,
                                "sortableUriKey" => "transaction_date",
                                "stacked" => false,
                                "textAlign" => "left",
                                "validationKey" => "transaction_date",
                                "value" => null
                            ],
                            [
                                "attribute" => "return_money",
                                "component" => "text-field",
                                "helpText" => null,
                                "indexName" => "طريقة ارجاع المال",
                                "name" => "طريقة ارجاع المال",
                                "nullable" => false,
                                "panel" => null,
                                "prefixComponent" => true,
                                "readonly" => false,
                                "required" => true,
                                "sortable" => false,
                                "sortableUriKey" => "return_money",
                                "stacked" => false,
                                "textAlign" => "left",
                                "validationKey" => "return_money",
                                "value" => null
                            ]
                        ],
                        "availableForEntireResource" => false,
                        "showOnDetail" => true,
                        "showOnIndex" => true,
                        "showOnTableRow" => false,
                        "standalone" => false,
                        "withoutConfirmation" => false
                    ]
                ],
                'fields' => [

                    [
                        'attribute' => 'bill_number',
                        'component' => 'text-field',
                        'help_text' => null,
                        "indexName" => __("bill_number"),
                        "name" => __("bill_number"),
                        'nullable' => false,
                        'panel' => null,
                        'prefix_component' => true,
                        'readonly' => false,
                        'required' => false,
                        'sortable' => false,
                        'sortable_uri_key' => 'bill_number',
                        'stacked' => false,
                        'text_align' => 'left',
                        'validation_key' => 'bill_number',
                        'value' => $transaction->bill_number
                    ],
                    [
                        "attribute" => "transaction_date",
                        "component" => "date",
                        "helpText" => null,
                        "indexName" => "تاريخ",
                        "name" => "تاريخ",
                        "nullable" => false,
                        "panel" => null,
                        "prefixComponent" => true,
                        "readonly" => false,
                        "required" => false,
                        "sortable" => false,
                        "sortableUriKey" => "transaction_date",
                        "stacked" => false,
                        "textAlign" => "left",
                        "validationKey" => "transaction_date",
                        "value" => Carbon::parse($transaction->transaction_date)->format('d-m-Y'),
                    ],
                    [
                        "belongsToId" => $transaction->ref_id,
                        "belongsToRelationship" => "project",
                        "debounce" => 500,
                        "displaysWithTrashed" => true,
                        "label" => "مشروع",
                        "resourceName" => "projects",
                        "reverse" => false,
                        "searchable" => false,
                        "withSubtitles" => false,
                        "showCreateRelationButton" => false,
                        "singularLabel" => "المشروع",
                        "viewable" => true,
                        "attribute" => "project",
                        "component" => "belongs-to-field",
                        "helpText" => null,
                        "indexName" => "المشروع",
                        "name" => "المشروع",
                        "nullable" => false,
                        "panel" => null,
                        "prefixComponent" => true,
                        "readonly" => false,
                        "required" => true,
                        "sortable" => false,
                        "sortableUriKey" => "ref_id",
                        "stacked" => false,
                        "textAlign" => "left",
                        "validationKey" => "project",
                        "value" => Project::find($transaction->ref_id)?->project_name,
                    ],
                    [


                        "attribute" => "transaction_status",
                        "component" => "select-field",
                        "helpText" => null,
                        "indexName" => __("transaction_status"),
                        "name" => __("transaction_status"),
                        "nullable" => false,
                        "panel" => null,
                        "prefixComponent" => true,
                        "readonly" => false,
                        "required" => false,
                        "sortable" => false,
                        "sortableUriKey" => "transaction_status",
                        "stacked" => false,
                        "textAlign" => "left",
                        "validationKey" => "transaction_status",
                        "value" =>   $statuses[$transaction->transaction_status] ?? __('Unknown status'),
                        "options" => [
                            [
                                "label" => "لم يتم التسليم بعد",
                                "value" => 1
                            ],
                            [
                                "label" => "في صندوق",
                                "value" => 2
                            ],
                            [
                                "label" => "في البنك",
                                "value" => 3
                            ]
                        ],
                        "searchable" => false,

                    ],
                    [
                        "indexName" => __("ReceiveDonation"),
                        "name" => __("ReceiveDonation"),
                        'attribute' => 'ReceiveDonation',
                        'component' => 'boolean-field',
                        'help_text' => null,

                        'nullable' => false,
                        'panel' => null,
                        'prefix_component' => true,
                        'readonly' => false,
                        'required' => false,
                        'sortable' => false,
                        'sortable_uri_key' => 'ReceiveDonation',
                        'stacked' => false,
                        'text_align' => 'center',
                        'validation_key' => 'ReceiveDonation',
                        'value' => true
                    ],
                    [
                        "indexName" => __("equivalent value"),
                        "name" => __("equivalent value"),
                        'component' => 'text-field',
                        'help_text' => null,
                        'index_name' => 'قيمة السند',
                        'nullable' => false,
                        'panel' => null,
                        'prefix_component' => true,
                        'readonly' => false,
                        'required' => false,
                        'sortable' => false,
                        'sortable_uri_key' => 'equivelant_amount',
                        'stacked' => false,
                        'text_align' => 'left',
                        'validation_key' => 'equivelant_amount',
                        'value' => $transaction->equivelant_amount,
                    ],
                    [
                        "indexName" => __("Donor"),
                        "name" => __("Donor"),
                        'attribute' => 'TelephoneDirectory',
                        'component' => 'belongs-to-field',
                        'debounce' => 500,
                        'displays_with_trashed' => true,
                        'help_text' => null,
                        'index_name' => 'متبرع',
                        'label' => 'SMS',
                        'nullable' => false,
                        'panel' => null,
                        'prefix_component' => true,
                        'readonly' => false,
                        'required' => true,
                        'resource_name' => 'telephone-directories',
                        'reverse' => false,
                        'searchable' => false,
                        'show_create_relation_button' => false,
                        'singular_label' => 'متبرع',
                        'sortable' => false,
                        'sortable_uri_key' => 'name',
                        'stacked' => false,
                        'text_align' => 'left',
                        'validation_key' => 'TelephoneDirectory',
                        'value' =>  TelephoneDirectory::find($transaction->name)?->name, //'קעדאן כאלד יחיא',
                        'viewable' => true,
                        'with_subtitles' => false
                    ],
                    [
                        "indexName" => __("Payment Type"),
                        "name" => __("Payment Type"),
                        'attribute' => 'Payment_type',
                        'component' => 'select-field',
                        'help_text' => null,
                        'index_name' => 'طريقة الدفع',
                        'nullable' => false,
                        'options' => [
                            ['label' => 'نقد', 'value' => 1],
                            ['label' => 'شيك', 'value' => 2],
                            ['label' => 'بيت', 'value' => 3],
                        ],
                        'panel' => null,
                        'prefix_component' => true,
                        'readonly' => false,
                        'required' => false,
                        'searchable' => false,
                        'sortable' => false,
                        'sortable_uri_key' => 'Payment_type',
                        'stacked' => false,
                        'text_align' => 'left',
                        'validation_key' => 'Payment_type',
                        "value" =>   $PaymentType[$transaction->Payment_type] ?? __('Unknown status'),
                    ],
                    [
                        "belongsToId" => $transaction->Created_By,
                        "belongsToRelationship" => "create",
                        "debounce" => 500,
                        "displaysWithTrashed" => true,
                        "label" => "موظفين اداريين",
                        "resourceName" => "users",
                        "reverse" => false,
                        "searchable" => false,
                        "withSubtitles" => false,
                        "showCreateRelationButton" => false,
                        "singularLabel" => "انشأ بواسطة",
                        "viewable" => true,
                        "attribute" => "create",
                        "component" => "belongs-to-field",
                        "helpText" => null,
                        "indexName" => "انشأ بواسطة",
                        "name" => "انشأ بواسطة",
                        "nullable" => false,
                        "panel" => null,
                        "prefixComponent" => true,
                        "readonly" => false,
                        "required" => true,
                        "sortable" => false,
                        "sortableUriKey" => "Created_By",
                        "stacked" => false,
                        "textAlign" => "left",
                        "validationKey" => "create",
                        "value" => User::find($transaction->Created_By)?->name

                    ],
                    [
                        "attribute" => "",
                        "component" => "nova-action-button",
                        "helpText" => null,
                        "indexName" => "",
                        "name" => "",
                        "nullable" => false,
                        "panel" => null,
                        "prefixComponent" => true,
                        "readonly" => $transaction->is_delete != 0 ? true : false,
                        "required" => false,
                        "sortable" => false,
                        "sortableUriKey" => "",
                        "stacked" => false,
                        "textAlign" => "left",
                        "validationKey" => "",
                        "value" => null,
                        "svg" => "delete",

                        "resourceId" => [2],
                        "text" => "compensation",
                        "showLoadingAnimation" => true,
                        "buttonColor" => "#FFFFFF",
                        "loadingColor" => "#fff",
                        "extraAttributes" => [
                            "readonly" => false,
                        ],
                        'action' => [
                            "cancelButtonText" => "إلغاء",
                            "component" => "confirm-action-modal",
                            "confirmButtonText" => "تعويض",
                            "class" => "btn-primary",
                            "confirmText" => "Are you sure you want to delete this?",
                            "destructive" => false,
                            "name" => "تعويض",
                            "uriKey" => "تعويض",
                            "fields" => [
                                [
                                    "attribute" => "transaction_date",
                                    "component" => "date",
                                    "helpText" => null,
                                    "indexName" => "تاريخ ",
                                    "name" => "تاريخ ",
                                    "nullable" => false,
                                    "panel" => null,
                                    "prefixComponent" => true,
                                    "readonly" => false,
                                    "required" => true,
                                    "sortable" => false,
                                    "sortableUriKey" => "transaction_date",
                                    "stacked" => false,
                                    "textAlign" => "left",
                                    "validationKey" => "transaction_date",
                                    "value" => null
                                ],
                                [
                                    "attribute" => "return_money",
                                    "component" => "text-field",
                                    "helpText" => null,
                                    "indexName" => "طريقة ارجاع المال",
                                    "name" => "طريقة ارجاع المال",
                                    "nullable" => false,
                                    "panel" => null,
                                    "prefixComponent" => true,
                                    "readonly" => false,
                                    "required" => true,
                                    "sortable" => false,
                                    "sortableUriKey" => "return_money",
                                    "stacked" => false,
                                    "textAlign" => "left",
                                    "validationKey" => "return_money",
                                    "value" => null
                                ]
                            ],
                            "availableForEntireResource" => false,
                            "showOnDetail" => true,
                            "showOnIndex" => true,
                            "showOnTableRow" => false,
                            "standalone" => false,
                            "withoutConfirmation" => false,
                            "resourceId" => [2]
                        ]

                    ],
                    [
                        "attribute" => "معاينة",
                        "component" => "nova-button",
                        "helpText" => null,
                        "indexName" => null,
                        "name" => "معاينة",
                        "nullable" => false,
                        "panel" => null,
                        "prefixComponent" => true,
                        "readonly" => false,
                        "required" => false,
                        "sortable" => false,
                        "sortableUriKey" => "معاينة",
                        "stacked" => false,
                        "textAlign" => "left",
                        "validationKey" => "معاينة",
                        "value" => null,
                        "key" => "معاينة",
                        "type" => "link",
                        "link" => [
                            "href" => "/mainbill/{$transaction->id}?type=bill",
                            "target" => "_blank"
                        ],
                        "text" => "معاينة",
                        "event" => "NovaButton\\Events\\ButtonClick",
                        "label" => null,
                        "route" => null,
                        "reload" => false,
                        "confirm" => null,
                        "visible" => true,
                        "classes" => [
                            "nova-button-transaction",
                            "bg-orange"
                        ],
                        "title" => null,
                        "indexAlign" => "right",
                        "errorText" => "Failed",
                        "errorClasses" => "cursor-pointer dim inline-block text-danger font-bold no-underline",
                        "successText" => "Success",
                        "successClasses" => "cursor-pointer dim inline-block text-success font-bold no-underline",
                        "loadingText" => "Loading",
                        "loadingClasses" => "cursor-pointer dim inline-block text-grey font-bold no-underline"

                    ],
                    [
                        "attribute" => "طباعة",
                        "component" => "nova-button",
                        "helpText" => null,
                        "indexName" => null,
                        "name" => "طباعة",
                        "nullable" => false,
                        "panel" => null,
                        "prefixComponent" => true,
                        "readonly" => false,
                        "required" => false,
                        "sortable" => false,
                        "sortableUriKey" => "طباعة",
                        "stacked" => false,
                        "textAlign" => "left",
                        "validationKey" => "طباعة",
                        "value" => null,
                        "key" => "طباعة",
                        "type" => "link",
                        "link" => [
                            "href" => "/generate-pdf/{$transaction->id}",
                            "target" => "_blank"
                        ],
                        "text" => "طباعة",
                        "event" => "NovaButton\\Events\\ButtonClick",
                        "label" => null,
                        "route" => null,
                        "reload" => false,
                        "confirm" => null,
                        "visible" => true,
                        "classes" => [
                            "nova-button-transaction",
                            "bg-orange"
                        ],
                        "title" => null,
                        "indexAlign" => "right",
                        "errorText" => "Failed",
                        "errorClasses" => "cursor-pointer dim inline-block text-danger font-bold no-underline",
                        "successText" => "Success",
                        "successClasses" => "cursor-pointer dim inline-block text-success font-bold no-underline",
                        "loadingText" => "Loading",
                        "loadingClasses" => "cursor-pointer dim inline-block text-grey font-bold no-underline"

                    ],
                    [
                        'attribute' => 'is_delete',
                        'component' => 'row-background',
                        'help_text' => null,
                        'index_name' => 'Net In Come',
                        'name' => 'Net In Come',
                        'nullable' => true,
                        'panel' => null,
                        'prefix_component' => true,
                        'readonly' => true,
                        'required' => false,
                        'sortable' => false,
                        'sortable_uri_key' => 'Net In Come',
                        'stacked' => false,
                        'text_align' => 'center',
                        'validation_key' => 'Net In Come',
                        'value' => $transaction->is_delete != 0 ? [
                            'backgroundColor' => '#A9A9A9',
                            'textColor' => '#000000'
                        ] : null,
                    ]
                ],
                "authorizedToView" => true,
                "authorizedToCreate" => true,
                "authorizedToUpdate" => true,
                "authorizedToDelete" => false,
                "authorizedToRestore" => true,
                "authorizedToForceDelete" => true,
                "softDeletes" => true,
                "softDeleted" => false,
                'title' => '1402',
                'id' => [
                    'attribute' => 'id',
                    'component' => 'id-field',
                    'helpText' => null,
                    'indexName' => 'ID',
                    'name' => 'ID',
                    'nullable' => false,
                    'panel' => null,
                    'prefixComponent' => true,
                    'readonly' => false,
                    'required' => false,
                    'sortable' => false,
                    'sortableUriKey' => 'id',
                    'stacked' => false,
                    'textAlign' => 'left',
                    'validationKey' => 'id',
                    'value' => $transaction->id, // Use the actual id value from the transaction
                    'softDeleted' => false,
                    'softDeletes' => true,
                    'title' => (string) $transaction->id, // Convert to string if needed
                ],
            ];
        });

        $response = [
            'label' => 'سندات قبض',
            'resources' => $resources,
            'total' => $transactions->total(),
            'per_page' => $transactions->perPage(),
            'current_page' => $transactions->currentPage(),
            'last_page' => $transactions->lastPage(),
            'prev_page_url' => $transactions->previousPageUrl(),
            'next_page_url' => $transactions->nextPageUrl(),
            'sortable' => true,
            'softDeletes' => true,
            'per_page_options' => [10, 25, 50, 100],
        ];

        return response()->json($response);
    }
    public function reportsApi(Request $request)
    {
        $page_size = isset($request->perPage) ? $request->perPage : 10;


        $decodedString = base64_decode($request->input('filters'));
        $array = json_decode($decodedString, true);
        $reports = Project::query(); // Start a query builder instance

        // Apply sorting only if orderBy and orderByDirection are provided
        if ($request->filled('orderBy') && $request->filled('orderByDirection')) {
            $reports->orderBy($request->get('orderBy'), $request->get('orderByDirection'));
        }

        if (is_array($array)) {
            foreach ($array as $item) {
                if (!empty($item['value'])) {
                    switch ($item['class']) {
                        case 'App\Nova\Filters\ReportCreated':
                            $user = User::where('name',  $item['value'])->first();
                            if ($user) {
                                $reports->where('Created_By', $user->id);
                            }

                            break;
                        case 'App\Nova\Filters\ProjectSectors':
                            $Sector = Sector::where('text', $item['value'])->first();
                            if ($Sector) {
                                $reports->where('sector', $Sector->id);
                            }
                            break;
                        case 'PosLifestyle\DateRangeFilter\DateRangeFilter_start_date':
                            if (isset($item['value'][0], $item['value'][1])) {


                                $reports->whereBetween(
                                    'start_date',
                                    [
                                        Carbon::createFromFormat('Y-m-d', $item['value'][0])->startOfDay(),
                                        Carbon::createFromFormat('Y-m-d', $item['value'][1])->endOfDay(),
                                    ]
                                );
                            }
                            break;


                        case 'App\Nova\Filters\ReportArea':
                            $Area = Area::where('name', $item['value'])->first();
                            if ($Area) {
                                $reports->where('area', $Area->id);
                            }

                            break;
                        case 'App\Nova\Filters\Reportcity':
                            $City = City::where('name', $item['value'])->first();
                            if ($City) {
                                $reports->where('city', $City->id);
                            }

                            break;


                        case 'App\Nova\Filters\ReportName':
                            $reports->where('project_name', $item['value']);







                        default:
                            break;
                    }
                }
            }
        }

        $reports = $reports->paginate($page_size);
        foreach ($reports as $q) {
            // Calculate income
            $in_come = Transaction::where([
                ['main_type', '=', 1],
                ['type', '=', 2],
                ['is_delete', '<>', '2'],
            ])->where('ref_id', $q->id)->sum('equivelant_amount');

            // Calculate outcome
            $out_come = Transaction::where('main_type', '2')->where('ref_id', $q->id)->sum('equivelant_amount');

            // Calculate net income
            $Net_in_come = $in_come - $out_come;

            // Update the project
            Project::where('id', $q->id)->update([
                'out_come' => $out_come,
                'in_come' => $in_come,
                'Net_in_come' => $Net_in_come
            ]);
        }

        // Map the reports into the desired structure
        $resources = $reports->map(function ($report) {
            return [
                'fields' => [
                    [
                        'attribute' => 'project_name',
                        'component' => 'text-field',
                        'helpText' => null,
                        'indexName' => 'اسم المشروع',
                        'name' => 'اسم المشروع',
                        'nullable' => false,
                        'panel' => null,
                        'prefixComponent' => true,
                        'readonly' => false,
                        'required' => true,
                        'sortable' => false,
                        'sortableUriKey' => 'project_name',
                        'stacked' => false,
                        'textAlign' => 'left',
                        'validationKey' => 'project_name',
                        'value' => "<a class='no-underline dim text-primary font-bold' href='/Admin/resources/reports/{$report->id}'>{$report->project_name}</a>",
                        'asHtml' => true,
                    ],
                    [
                        'belongsToId' => $report?->Sectors?->id,
                        'belongsToRelationship' => 'Sectors',
                        'debounce' => 500,
                        'displaysWithTrashed' => true,
                        'label' => 'قطاعات',
                        'resourceName' => 'sectors',
                        'reverse' => false,
                        'searchable' => false,
                        'withSubtitles' => false,
                        'showCreateRelationButton' => false,
                        'singularLabel' => 'قطاع',
                        'viewable' => true,
                        'attribute' => 'Sectors',
                        'component' => 'belongs-to-field',
                        'helpText' => null,
                        'indexName' => 'قطاع',
                        'name' => 'قطاع',
                        'nullable' => true,
                        'panel' => null,
                        'prefixComponent' => true,
                        'readonly' => false,
                        'required' => false,
                        'sortable' => false,
                        'sortableUriKey' => 'sector',
                        'stacked' => false,
                        'textAlign' => 'left',
                        'validationKey' => 'Sectors',
                        'value' => $report?->Sectors?->text,
                    ],
                    [
                        'attribute' => 'start_date',
                        'component' => 'date-time',
                        'helpText' => null,
                        'indexName' => 'تاربج بدء المشروع',
                        'name' => 'تاربج بدء المشروع',
                        'nullable' => false,
                        'panel' => null,
                        'prefixComponent' => true,
                        'readonly' => false,
                        'required' => true,
                        'sortable' => false,
                        'sortableUriKey' => 'start_date',
                        'stacked' => false,
                        'textAlign' => 'left',
                        'validationKey' => 'start_date',
                        'value' => $report->start_date
                    ],
                    [
                        'belongsToId' => $report?->create?->id,
                        'belongsToRelationship' => 'create',
                        'debounce' => 500,
                        'displaysWithTrashed' => true,
                        'label' => 'موظفين اداريين',
                        'resourceName' => 'users',
                        'reverse' => false,
                        'searchable' => false,
                        'withSubtitles' => false,
                        'showCreateRelationButton' => false,
                        'singularLabel' => 'انشأ بواسطة',
                        'viewable' => true,
                        'attribute' => 'create',
                        'component' => 'belongs-to-field',
                        'helpText' => null,
                        'indexName' => 'انشأ بواسطة',
                        'name' => 'انشأ بواسطة',
                        'nullable' => false,
                        'panel' => null,
                        'prefixComponent' => true,
                        'readonly' => false,
                        'required' => true,
                        'sortable' => false,
                        'sortableUriKey' => 'created_by',
                        'stacked' => false,
                        'textAlign' => 'left',
                        'validationKey' => 'create',
                        'value' => $report?->create?->name
                    ],
                    [
                        'attribute' => 'in_come',
                        'component' => 'text-field',
                        'helpText' => null,
                        'indexName' => 'مدخلات',
                        'name' => 'مدخلات',
                        'nullable' => false,
                        'panel' => null,
                        'prefixComponent' => true,
                        'readonly' => false,
                        'required' => false,
                        'sortable' => true,
                        'sortableUriKey' => 'in_come',
                        'stacked' => false,
                        'textAlign' => 'left',
                        'validationKey' => 'in_come',
                        'value' => $report->in_come,
                        'calculate' => 'sum',
                        'title' => 'المجموع',
                        'postfix' => '',
                        'prefix' => ''
                    ],
                    [
                        'attribute' => 'out_come',
                        'component' => 'text-field',
                        'helpText' => null,
                        'indexName' => 'مخرجات',
                        'name' => 'مخرجات',
                        'nullable' => false,
                        'panel' => null,
                        'prefixComponent' => true,
                        'readonly' => false,
                        'required' => false,
                        'sortable' => true,
                        'sortableUriKey' => 'out_come',
                        'stacked' => false,
                        'textAlign' => 'left',
                        'validationKey' => 'out_come',
                        'value' => $report->out_come,
                        'calculate' => 'sum',
                        'title' => 'المجموع',
                        'postfix' => '',
                        'prefix' => ''
                    ],
                    [
                        'attribute' => 'Net_in_come',
                        'component' => 'text-field',
                        'helpText' => null,
                        'indexName' => 'صافي',
                        'name' => 'صافي',
                        'nullable' => false,
                        'panel' => null,
                        'prefixComponent' => true,
                        'readonly' => false,
                        'required' => false,
                        'sortable' => true,
                        'sortableUriKey' => 'Net_in_come',
                        'stacked' => false,
                        'textAlign' => 'left',
                        'validationKey' => 'Net_in_come',
                        'value' => $report->Net_in_come,
                        'calculate' => 'sum',
                        'title' => 'المجموع',
                        'postfix' => '',
                        'prefix' => ''
                    ],
                    [
                        'attribute' => 'Net_in_come',
                        'component' => 'row-background',
                        'helpText' => null,
                        'indexName' => 'Net In Come',
                        'name' => 'Net In Come',
                        'nullable' => false,
                        'panel' => null,
                        'prefixComponent' => true,
                        'readonly' => false,
                        'required' => false,
                        'sortable' => false,
                        'sortableUriKey' => 'Net_in_come',
                        'stacked' => false,
                        'textAlign' => 'left',
                        'validationKey' => 'Net_in_come',
                        "value" => $report->Net_in_come < 0 ? [
                            "backgroundColor" => "#ff9999",
                            "textColor" => "#000000"
                        ] : null
                    ]
                ],
                "authorizedToView" => true,
                "authorizedToCreate" => false,
                "authorizedToUpdate" => false,
                "authorizedToDelete" => false,
                "authorizedToRestore" => false,
                "authorizedToForceDelete" => false,
                "softDeletes" => false,
                "softDeleted" => false,
                'title' => '1402',
                'id' => [
                    'attribute' => 'id',
                    'component' => 'id-field',
                    'helpText' => null,
                    'indexName' => 'ID',
                    'name' => 'ID',
                    'nullable' => false,
                    'panel' => null,
                    'prefixComponent' => true,
                    'readonly' => false,
                    'required' => false,
                    'sortable' => false,
                    'sortableUriKey' => 'id',
                    'stacked' => false,
                    'textAlign' => 'left',
                    'validationKey' => 'id',
                    'value' => $report->id,
                    'softDeleted' => false,
                    'softDeletes' => true,
                    'title' => (string) $report->id,
                ],
            ];
        });

        // Prepare the response with pagination data
        $response = [
            'label' => 'سندات قبض',
            'resources' => $resources,
            'total' => $reports->total(),
            'per_page' => $reports->perPage(),
            'current_page' => $reports->currentPage(),
            'last_page' => $reports->lastPage(),
            'prev_page_url' => $reports->previousPageUrl(),
            'next_page_url' => $reports->nextPageUrl(),
            'sortable' => true,
            'softDeletes' => true,
            'per_page_options' => [10, 25, 50, 100],
        ];

        return response()->json($response);
    }
}
