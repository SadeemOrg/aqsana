<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {



        $Heros = nova_get_setting('heroo', 'default_value');


        $lastnews = DB::table('news')->orderBy('created_at', 'desc')->take(2)->get();

        $news = DB::table('news')->orderBy('created_at', 'desc')->get();

        $ProjectsNews = nova_get_setting('Projects_News', 'default_value');
        // $ProjectsNews = json_decode($ProjectsNewsjson);




        $Articles = DB::table('related_articles')->orderBy('created_at', 'desc')->get();


        $partners = nova_get_setting('partner', 'default_value');
        // $partners = json_decode($partnerjson);

        $sectors = nova_get_setting('workplace', 'default_value');
        // $sectors= json_decode($sectorsjson);



        return view('Pages.home', compact('Heros', 'lastnews', 'news', 'ProjectsNews', 'Articles', 'partners','sectors'));
    }

    public function news()
    {


        $news = DB::table('news')->orderBy('created_at', 'desc')->paginate( 3 );
        return view('Pages.our-news', compact('news'));


    }
    public function aboutus()
    {


        $goalsjson = nova_get_setting('goals', 'default_value');
        $goals = json_decode($goalsjson);


        $achievementsjson = nova_get_setting('achievements', 'default_value');
        $achievements = json_decode($achievementsjson);


        $workplace = nova_get_setting('workplaceabout', 'default_value');
        return view('Pages.about-us-page', compact('goals','achievements','workplace'));
    }

    public function conctus()
    {
            return"okk";
    }

    public function getnewDetail($id)
    {
        $news = DB::table('news')->where('id',$id)->first();
        // dd($news->pictures);
        $goalsjson=$news->pictures;
        // dd($goalsjson);
        // $goals = json_decode($goalsjson,true);
        // dd(gettype($goals));
        $pictures = json_decode( json_decode($goalsjson,true),true);

            // dd(gettype($pictures));
        return view('single-news', compact('news','pictures'));
    }
}
