<?php

namespace App\Http\Controllers;
use App\Models\Section;

use App\Models\SocialNetwork;
use Illuminate\Http\Request;

class KnowMeController extends Controller
{
    public function index()
    {
        $socialnetworks = SocialNetwork::all();
        $sections = Section::all();
        return view('knowme',compact('sections','socialnetworks'));
    }
}
