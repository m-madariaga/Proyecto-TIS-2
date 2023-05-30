<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KnowMeController extends Controller
{
    public function index()
    {
        return view('knowme');
    }
}
