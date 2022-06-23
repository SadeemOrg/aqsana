<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {



        $Heros = nova_get_setting('Flexible', 'default_value');


        $lastnews = DB::table('news')->orderBy('created_at', 'desc')->take(2)->get();

        $news = DB::table('news')->orderBy('created_at', 'desc')->get();

        $ProjectsNews = nova_get_setting('Projects_News', 'default_value');
        // $ProjectsNews = json_decode($ProjectsNewsjson);




        $Articles = DB::table('related_articles')->orderBy('created_at', 'desc')->get();


        $partners = nova_get_setting('partner', 'default_value');
        // $partners = json_decode($partnerjson);

        $sectors = nova_get_setting('workplace', 'default_value');
        // $sectors= json_decode($sectorsjson);

        $footers = nova_get_setting('Itemsfooter', 'default_value');
        // $footers = json_decode($footerjson);


        return view('home', compact('Heros', 'lastnews', 'news', 'ProjectsNews', 'Articles', 'partners','footers','sectors'));
    }
}
