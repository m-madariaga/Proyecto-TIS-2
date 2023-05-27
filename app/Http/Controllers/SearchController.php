<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = [];

        $results = Product::where('nombre', 'LIKE', '%' . $query . '%')->get();

        return view('search_results')->with('results', $results);
    }
}
