<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Review;
use App\Models\Product;
use App\Models\Action;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request, $productId, $userId)
    {
        error_log("test");
        error_log($request->title);
        error_log($request->type);
        error_log($request->description);
        error_log($userId);
        error_log($productId);
        $request->validate([
            'title' => 'required',
            'type' => 'nullable',
            'description' => 'required',
        ]);

        error_log("function start");
 
        

        $review = new Review();
            $review->user_fk= $userId;
            $review->product_fk= $productId;
            $review->title= $request->title;
            $review->type= $request->type;
            $review->description= $request->description;
        $review->save();
        error_log("function end");

        return redirect('/product/'.$productId)->with('success', 'Reseña creada exitosamente!');
    }

    public function destroy($id)
    {
        $review = Review::find($id);
        $review->delete();
        error_log("test");

        $action = new Action();
            $action->name = 'Eliminación Reseña';
            $action->user_fk = Auth::User()->id;
        $action->save();

        return response()->json(['success' => true]);

    }


}
