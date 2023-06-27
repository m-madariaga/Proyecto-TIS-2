<?php

namespace App\Http\Controllers;
use App\Models\Section;

use Illuminate\Http\Request;

class KnowMeController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('knowme',compact('sections'));
    }
}
