<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\Section;

use App\Models\SocialNetwork;
use Illuminate\Http\Request;

class KnowMeController extends Controller
{
    public function index()
    {
        $socialnetworks = SocialNetwork::all();
        $images = Images::where('seleccionada', 1)->get();
        $sections = Section::all();
        return view('knowme',compact('sections','socialnetworks','images'));
    }
}
