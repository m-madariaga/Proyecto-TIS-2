<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileLandingController extends Controller
{
    public function showProfile()
    {
        return view('profile_landing');
    }
}
