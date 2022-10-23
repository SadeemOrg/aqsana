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
use App\Models\Book;
use App\Models\BookType;
use App\Models\Donations;
use App\Models\News;
use App\Models\newsType;
use App\Models\Project;
use App\Models\Sector;
use App\Models\Transaction;
use Illuminate\Support\Facades\Mail;
class HomeController extends Controller
{


    public function first(Request $request)
    {
        // return $request->project_id;
        // dd($project_id);
        //  $projects = DB::tableس('projects')->where('report_status', '=', '1')->orderBy('report_date', 'desc')->paginate(9);
        $projects = Project::where('sector', '=', $request->project_id)->get();
        // $    projects =$projects = Project::where('report_status', '=', '1');
        // $projects = Project::all();
        // dd($projects);
        return $projects;
    }
    public function Sectors()
    {
        // return $request->project_id;
        // dd($project_id);
        //  $projects = DB::tableس('projects')->where('report_status', '=', '1')->orderBy('report_date', 'desc')->paginate(9);
        $Sectors = Sector::all();
        // $    projects =$projects = Project::where('report_status', '=', '1');
        return $Sectors;
    }

    public function originalbillbills($id)
    {
        $Transaction =  Transaction::where("id", $id)->first();
        $original=1;

        return view('Pages.Bills.Bills', compact('Transaction','original'));
    }

    public function bills($id)
    {
        $Transaction =  Transaction::where("id", $id)->first();
        $original=0;

        return view('Pages.Bills.Bills', compact('Transaction','original'));
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

        $sectors = nova_get_setting('workplace', 'default_value');
        // $sectors= json_decode($sectorsjson);

        return view('Pages.home', compact('Heros', 'lastnews', 'news', 'ProjectsNews', 'partners', 'sectors'));
    }
    public function aboutus()
    {
        $goalsjson = nova_get_setting('goals', 'default_value');
        $goals = json_decode($goalsjson);
        $achievementsjson = nova_get_setting('achievements', 'default_value');
        $achievements = json_decode($achievementsjson);
        $workplace = nova_get_setting('workplace', 'default_value');
        return view('Pages.about-us-page', compact('goals', 'achievements', 'workplace'));
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
        $books = Book::all();
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
        // dd($sector);mainType
        $mainType = "قطاع";
        $type = $sector;
        $news = News::query()->where('sector', $sector)

            ->paginate(9);

        return view('Pages.news-page', compact('news', 'mainType', 'type'));
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

        //  dd($News);
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

    public function mainbill($id)
    {
        $type='1';
        return view('Pages.Bills.mainBill',compact('id','type'));
    }


}
