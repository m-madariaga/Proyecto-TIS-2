<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\Section;
use App\Models\SocialNetwork;
use Illuminate\Http\Request;

class TermsConditionsController extends Controller
{
    public function index()
    {
        $images = Images::where('seleccionada', 1)->get();

        $socialnetworks = SocialNetwork::all();
        $sections = Section::all();
        return view('termsconditions',compact('sections','socialnetworks','images'));
    }
}
