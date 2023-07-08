<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\Product;
use App\Models\Section;
use App\Models\SocialNetwork;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $socialnetworks = SocialNetwork::all();
        $sections = Section::all();
        $images = Images::where('seleccionada', 1)->get();

        $query = $request->input('query');
        $results = [];
        $results = Product::where('nombre', 'LIKE', '%' . $query . '%')->get();

        return view('search_results',compact('results','sections','socialnetworks','images'));
    }
}
