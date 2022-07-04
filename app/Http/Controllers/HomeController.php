<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Mail;
use App\Mail\TestMail;



class HomeController extends Controller
{





    public function getProduct(int $id, string $slug)
    {
     dd("nbddj");
    }








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

        $mail = 'your_email_id@gmail.com';
        Mail::to($mail)->send(new TestMail);

        // return redirect()->back();
        // $input = $request->all();
        // $validator = Validator::make($input,[
        //     'name'=> 'required|string',
        //     'phone'=> 'required|string',
        //     'message'=>'required|string|email',

        // ]);
        // if ($validator->fails()) {
        //     return redirect()->back()->with('error', 'Something went wrong.');
        // }
        // return redirect()->back();

    }


    public function news($maintype,$type )
    {
        $news = DB::table('news')->where([
            ['main_type', '=', $maintype],
            ['type', '=', $type],
        ])->paginate(8);
        $mainType = DB::table('news_types')->where([
            ['main_type', '=', $maintype],
            ['type', '=', '0'],
        ])->first();


        $type = DB::table('news_types')->where([
            ['main_type', '=', $maintype],
            ['type', '=', $type ],
        ])->first();

        return view('Pages.our-news', compact('news', 'mainType', 'type'));
        // $news = DB::table('news')->orderBy('created_at', 'desc')->paginate(8);
        // return view('Pages.our-news', compact('news'));
    }
    public function getnewDetail($id)
    {
        $new = DB::table('news')->where('id', $id)->first();
        // dd($news);
        $Articles = DB::table('news')->where([
            ['type', '=', $new->type],
            ['main_type', '=', $new->main_type],
        ])->orderBy('created_at', 'desc')->take(6)->get();
        // dd($newser);
        // dd($news->pictures);
        $goalsjson = $new->pictures;
        // dd($goalsjson);
        // $goals = json_decode($goalsjson,true);
        // dd(gettype($goals));
        $pictures = json_decode(json_decode($goalsjson, true), true);

        // dd(gettype($pictures));
        return view('pages.single-news', compact('new', 'pictures', 'Articles'));
    }

    // // Alquds



    // public function Alquds_news()
    // {
    //     $news = DB::table('news')->where([
    //         ['type', '=', '1'],
    //         ['main_type', '=', '0'],
    //     ])->paginate(8);
    //     // dd($news);
    //     // $Articles = DB::table('news')

    //     // ->where([
    //     //     ['type', '=', $news[0]->type],
    //     //     ['main_type', '=', '0'],
    //     //             ])
    //     // ->orderBy('created_at', 'desc')->take(6)->get();
    //     // dd($Articles);
    //     // dd($newser);
    //     // dd($news->pictures);
    //     // $goalsjson=$news->pictures;
    //     // dd($goalsjson);
    //     // $goals = json_decode($goalsjson,true);
    //     // dd(gettype($goals));
    //     // $pictures = json_decode( json_decode($goalsjson,true),true);

    //     return view('Pages.our-news', compact('news'));
    // }
    // public function Alquds_blog()
    // {
    //     $news = DB::table('news')->where([
    //         ['type', '=', '1'],
    //         ['main_type', '=', '1'],
    //     ])->paginate(8);
    //     // dd($news);
    //     // $Articles = DB::table('news')

    //     // ->where([
    //     //     ['type', '=', $news[0]->type],
    //     //     ['main_type', '=', '1'],
    //     //             ])
    //     // ->orderBy('created_at', 'desc')->take(6)->get();
    //     // // dd($Articles);
    //     // // dd($newser);
    //     // // dd($news->pictures);
    //     // $goalsjson=$news->pictures;
    //     // // dd($goalsjson);
    //     // // $goals = json_decode($goalsjson,true);
    //     // // dd(gettype($goals));
    //     // $pictures = json_decode( json_decode($goalsjson,true),true);

    //     return view('Pages.our-news', compact('news'));
    // }
    // public function Alquds_report()
    // {
    //     $news = DB::table('news')->where([
    //         ['type', '=', '1'],
    //         ['main_type', '=', '2'],
    //     ])->paginate(8);
    //     // dd($news);
    //     // $Articles = DB::table('news')

    //     // ->where([
    //     //     ['type', '=', $news[0]->type],
    //     //     ['main_type', '=', '2'],
    //     //             ])
    //     // ->orderBy('created_at', 'desc')->take(6)->get();
    //     // // dd($Articles);
    //     // // dd($newser);
    //     // // dd($news->pictures);
    //     // $goalsjson=$news->pictures;
    //     // // dd($goalsjson);
    //     // // $goals = json_decode($goalsjson,true);
    //     // // dd(gettype($goals));
    //     // $pictures = json_decode( json_decode($goalsjson,true),true);

    //     return view('Pages.our-news', compact('news'));
    // }



    // //holy


    // public function holy_news()
    // {
    //     $news = DB::table('news')->where([
    //         ['type', '=', '2'],
    //         ['main_type', '=', '0'],
    //     ])->paginate(8);
    //     // dd($news);
    //     // $Articles = DB::table('news')

    //     // ->where([
    //     //     ['type', '=', $news[0]->type],
    //     //     ['main_type', '=', '0'],
    //     //             ])
    //     // ->orderBy('created_at', 'desc')->take(6)->get();
    //     // dd($Articles);
    //     // dd($newser);
    //     // dd($news->pictures);
    //     // $goalsjson=$news->pictures;
    //     // dd($goalsjson);
    //     // $goals = json_decode($goalsjson,true);
    //     // dd(gettype($goals));
    //     // $pictures = json_decode( json_decode($goalsjson,true),true);

    //     return view('Pages.our-news', compact('news'));
    // }
    // public function holy_blog()
    // {
    //     $news = DB::table('news')->where([
    //         ['type', '=', '2'],
    //         ['main_type', '=', '1'],
    //     ])->paginate(8);
    //     // dd($news);
    //     // $Articles = DB::table('news')

    //     // ->where([
    //     //     ['type', '=', $news[0]->type],
    //     //     ['main_type', '=', '1'],
    //     //             ])
    //     // ->orderBy('created_at', 'desc')->take(6)->get();
    //     // // dd($Articles);
    //     // // dd($newser);
    //     // // dd($news->pictures);
    //     // $goalsjson=$news->pictures;
    //     // // dd($goalsjson);
    //     // // $goals = json_decode($goalsjson,true);
    //     // // dd(gettype($goals));
    //     // $pictures = json_decode( json_decode($goalsjson,true),true);

    //     return view('Pages.our-news', compact('news'));
    // }
    // public function holy_report()
    // {
    //     $news = DB::table('news')->where([
    //         ['type', '=', '2'],
    //         ['main_type', '=', '2'],
    //     ])->paginate(8);
    //     // dd($news);
    //     // $Articles = DB::table('news')

    //     // ->where([
    //     //     ['type', '=', $news[0]->type],
    //     //     ['main_type', '=', '2'],
    //     //             ])
    //     // ->orderBy('created_at', 'desc')->take(6)->get();
    //     // // dd($Articles);
    //     // // dd($newser);
    //     // // dd($news->pictures);
    //     // $goalsjson=$news->pictures;
    //     // // dd($goalsjson);
    //     // // $goals = json_decode($goalsjson,true);
    //     // // dd(gettype($goals));
    //     // $pictures = json_decode( json_decode($goalsjson,true),true);

    //     return view('Pages.our-news', compact('news'));
    // }

    // public function annualnews($id)
    // {
    //     $new = DB::table('news')->where('id', $id)->first();
    //     // dd($news);
    //     $Articles = DB::table('news')->where([
    //         ['type', '=', $new->type],
    //         ['main_type', '=', $new->main_type],
    //     ])->orderBy('created_at', 'desc')->take(6)->get();
    //     // dd($newser);
    //     // dd($news->pictures);
    //     $goalsjson = $new->pictures;
    //     // dd($goalsjson);
    //     // $goals = json_decode($goalsjson,true);
    //     // dd(gettype($goals));
    //     $pictures = json_decode(json_decode($goalsjson, true), true);

    //     // dd(gettype($pictures));
    //     return view('pages.annual-news', compact('new', 'pictures', 'Articles'));
    // }
}
