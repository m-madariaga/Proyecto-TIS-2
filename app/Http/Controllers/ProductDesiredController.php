<?php

namespace App\Http\Controllers;

use App\Models\Product_desired;
use App\Models\User;
use Illuminate\Http\Request;

class ProductDesiredController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_and_delete(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
        ]);
        //si existe el producto que se intenta agregar, entonces se debe borrar
        $existe_producto = Product_desired::where('user_id', $request->get('user_id'))
            ->where('product_id', $request->get('product_id'))
            ->exists();
        if ($existe_producto) {
            $p = Product_desired::all()
                ->where('user_id', $request->get('user_id'))
                ->where('product_id', $request->get('product_id'));
            foreach ($p as $key => $value) {
                $value->delete();
            }
            return back();
        }
        $prod_desired = new Product_desired([
            'user_id' => $request->get('user_id'),
            'product_id' => $request->get('product_id'),
        ]);
        $prod_desired->save();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product_desired  $Product
     * @return \Illuminate\Http\Response
     */
    public function show(User $id)
    {
        $productos_deseados = $id->product_desired;
        dd($productos_deseados);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product_desired  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_desired $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product_desired  $Product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product_desired $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product_desired  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product_desired $id)
    {

    }
}
