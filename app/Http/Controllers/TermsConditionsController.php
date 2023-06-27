<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\SocialNetwork;
use Illuminate\Http\Request;

class TermsConditionsController extends Controller
{
    public function index()
    {
        $socialnetworks = SocialNetwork::all();
        $sections = Section::all();
        return view('termsconditions',compact('sections','socialnetworks'));
    }
}
