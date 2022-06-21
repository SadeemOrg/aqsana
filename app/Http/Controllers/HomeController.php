<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public function index()
    {

$Herojson=nova_get_setting('heroo', 'default_value');
$Hero = json_decode($Herojson);

$lastnew=DB::table('news')->orderBy('created_at', 'desc')->take(2)->get();

$new=DB::table('news')->orderBy('created_at', 'desc')->get();

$ProjectsNewsjson=nova_get_setting('ProjectsNews', 'default_value');
$ProjectsNews = json_decode($ProjectsNewsjson);

//project


$Articles=DB::table('related_articles')->orderBy('created_at', 'desc')->get();


$partnerjson=nova_get_setting('partner', 'default_value');
$partner = json_decode($partnerjson);

//sectors




return view('home', compact('Hero','lastnew','new','ProjectsNews','Articles','partner'));
    }
}
