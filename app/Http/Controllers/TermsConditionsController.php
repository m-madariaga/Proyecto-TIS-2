<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class TermsConditionsController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('termsconditions',compact('sections'));
    }
}
