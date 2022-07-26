<?php

namespace App\Http\Controllers;

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

    public function index()
    {

        $Heros = nova_get_setting('heroo', 'default_value');


        $lastnews = DB::table('news')->orderBy('created_at', 'desc')->take(2)->get();

        $news = DB::table('news')->orderBy('created_at', 'desc')->get();

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
        $workplace = nova_get_setting('workplaceabout', 'default_value');
        return view('Pages.about-us-page', compact('goals', 'achievements', 'workplace'));
    }
    public function conctusee(Request $request)
    {
        return "asa";
    }
    public function conctus(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'message' => 'required|string',

        ]);


        FormMassage::create([
            'name' => $request['name'],
            'phone' => $request['phone'],
            'message' => $request['message'],

        ]);
        return redirect()->back();
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
            ['main_type', '=', $main_type->main_type],
            ['type', '=', $Type->type],
        ])->paginate(8);


        $mainType = str_replace("-", " ", $maintype);
        $type = str_replace("-", " ", $type);
        return view('Pages.our-news', compact('news', 'mainType', 'type'));
    }

    public function getnewDetail($id)
    {
        $new = DB::table('news')->where('id', $id)->first();

        $Articles = DB::table('news')->where([
            ['type', '=', $new->type],
            ['main_type', '=', $new->main_type],
        ])->orderBy('created_at', 'desc')->take(6)->get();

        $goalsjson = $new->pictures;

        $pictures = json_decode(json_decode($goalsjson, true), true);

        $mainType = DB::table('news_types')->where([
            ['main_type', '=', $new->main_type],
            ['type', '=', '0'],
        ])->first();




        return view('Pages.single-news', compact('new', 'pictures', 'Articles', 'mainType'));
    }





    public function search($search)
    {
        $main_type = newsType::where('name', 'like',  '%' . $search . '%')
            ->select('main_type')->get();



        $stack_main_type = array();
        foreach ($main_type as $key => $value) {
            array_push($stack_main_type, $value->main_type);
        }

        $News = News::whereIn('main_type', $stack_main_type)
            ->orWhere('title', 'like',  $search)
            ->orWhere('sector', 'like',  $search)
            ->get();
        // foreach ($News as $key => $value) {
        //     echo  $value->title;
        //     echo '<br>';
        // }
return $News;
        // return dd($News);
    }
}
