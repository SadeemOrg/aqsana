<?php

namespace App\Http\Controllers;

use Actengage\Wizard\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\FormMassage;
use Mail;
use App\Mail\TestMail;
use App\Models\News;
use App\Models\newsType;


class HomeController extends Controller
{
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
    public function conctusee(Request $request)
    {
        return "asa";
    }
    public function conctus(Request $request)
    {

        $validator = Validator::make($request->all(), [
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
        ]);
        if ($validator->passes()) {
            return response()->json(['success'=>'Added new records.']);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }


    public function news($maintype, $type)
    {
        // dd($maintype, $type);
        $main_type = newsType::where('name', $maintype)
            ->where('type', '0')
            ->select('main_type')->first();

        $Type = newsType::where('name', $type)
            ->where('main_type', $main_type->main_type)
            ->select('type')->first();
        // dd($Type->type);

        $news = DB::table('news')->where([
            ['main_type', 'like', '%' . $main_type->main_type . '%'],
            ['type', '=', $Type->type],
        ])->orderBy('new_date', 'desc')->paginate(8);



        $mainType = str_replace("-", " ", $maintype);
        $type = str_replace("-", " ", $type);
        return view('Pages.news-page', compact('news', 'mainType', 'type'));
    }

    public function getnewDetail($title, $id)
    {

        $new = DB::table('news')->where('id', $id)->first();
        // dd($new);

        $Articles = DB::table('news')->where([
            ['type', '=', $new->type],
            ['main_type', '=', $new->main_type],
        ])->orderBy('new_date', 'desc')->take(6)->get();

        $goalsjson = $new->pictures;

        $pictures = json_decode(json_decode($goalsjson, true), true);

        $total =  json_decode(json_decode($new->main_type, true), true);

        if (gettype($total) == "string") {
            $tt =  str_replace('"', "", $total);

            $mainType = DB::table('news_types')->where([
                ['main_type', 'like',  $tt],
                ['type', '=', '0'],
            ])->first();
            $mainType =  $mainType->name;
            //  dd(   $mainType);
        } else $mainType = "اخبار";
        // $coutotal =  count( $total);

        //         $mainType = DB::table('news_types')->where([
        //             ['main_type', '=', $new->main_type],
        //             ['type', '=', '0'],
        //         ])->first();


        // dd( $new->main_type);

        return view('Pages.news-details-page', compact('new', 'pictures', 'Articles', 'mainType'));
    }



    public function sector($sector)
    {
        // dd($sector);mainType
        $mainType = "قطاع";
        $type = $sector;
        $news = News::query()->where('sector', $sector)

            ->paginate(8);

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
            ->paginate(8);
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

        $projects = DB::table('projects')->where('report_status', '=', '1')->orderBy('report_date', 'desc')->paginate(8);
        return view('Pages.ProjectsDetails.projects-page', compact('projects'));
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
}
