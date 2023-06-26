<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $sections = Section::all();

        $query = $request->input('query');
        $results = [];
        $results = Product::where('nombre', 'LIKE', '%' . $query . '%')->get();

        return view('search_results',compact('results','sections'));
    }
}
