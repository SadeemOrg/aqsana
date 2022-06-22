<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {



        $Herojson = nova_get_setting('heroo', 'default_value');
        $Heros = json_decode($Herojson);

        $lastnews = DB::table('news')->orderBy('created_at', 'desc')->take(2)->get();

        $news = DB::table('news')->orderBy('created_at', 'desc')->get();

        $ProjectsNewsjson = nova_get_setting('ProjectsNews', 'default_value');
        $ProjectsNews = json_decode($ProjectsNewsjson);




        $Articles = DB::table('related_articles')->orderBy('created_at', 'desc')->get();


        $partnerjson = nova_get_setting('partner', 'default_value');
        $partners = json_decode($partnerjson);

        $sectorsjson = nova_get_setting('workplace', 'default_value');
        $sectors= json_decode($sectorsjson);

        $footerjson = nova_get_setting('Itemsfooter', 'default_value');
        $footers = json_decode($footerjson);


        return view('home', compact('Heros', 'lastnews', 'news', 'ProjectsNews', 'Articles', 'partners','footers','sectors'));
    }
}
