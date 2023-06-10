<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;
use App\Models\Product;

class ReviewsController extends Controller
{
    public function index()
    {
        $reviews = Review::all();

        foreach($reviews as $review){
            
            $user = User::find($review->user_fk);
            $product = Product::find($review->product_fk);
            $review->user= $user->name;
            $review->product = $product->nombre;

        }

        return view('reviews.index', compact('reviews'));
    }


}
