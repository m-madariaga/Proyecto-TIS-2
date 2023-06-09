<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\Product;
use App\Models\Promotion;
use App\Models\Section;
use App\Models\SocialNetwork;
use Illuminate\Http\Request;

class HomeLandingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        $socialnetworks = SocialNetwork::all();
        $images = Images::where('seleccionada', 1)->get();
        $promociones = Promotion::all();
        $product = Product::first(); // Obtener el primer producto de la colección
        $recommendedProducts = $this->getRecommendedProducts($product->id);
        return view('home-landing', compact('sections', 'images', 'socialnetworks','promociones','recommendedProducts'));
    }

    public function getRecommendedProducts($productId)
    {
        // Obtener el producto actual
        $product = Product::findOrFail($productId);

        // Obtener todos los productos excepto el actual
        $recommendedProducts = Product::where('id', '!=', $productId)
            ->inRandomOrder()
            ->get();

        return $recommendedProducts;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
