<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase_order;
use App\Models\Purchase_order_product;
use Illuminate\Http\Request;

class PurcharseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordenes = Purchase_order::all();
        return view('purchase_order.index', compact('ordenes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Product::all();
        $marcas = Brand::all();
        $categorias = Category::all();
        return view('purchase_order.create', compact('productos','marcas','categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'prod_id' => 'required',
            'cantidad' => 'required',
            'valor' => 'required',
        ]);
        //se calcula el valor total de la orden
        $aux = 0;
        $size = sizeof($datos['cantidad']);
        for ($i = 0; $i < $size; $i++) {
            if ($datos['cantidad'][$i] != null) {
                $cantidad = $datos['cantidad'][$i] * $datos['valor'][$i];
                $aux += $cantidad;
            }
        }
        $total = $aux;
        $orden = new Purchase_order([
            'total' => $total,
        ]);
        $orden->save();
        $orden_id = $orden->id;
        return redirect()->route('orden-compra-product-store', compact('datos', 'orden_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase_order  $Product
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase_order $purchase_order)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase_order  $Purchase_order
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase_order $id)
    {
        $orden = $id;
        $orden_productos = $orden->product;
        $productosall = Product::all();
        return view('purchase_order.edit', compact('orden','orden_productos','productosall'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase_order  $Purchase_order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase_order $id)
    {
        $datos = $request->validate([
            'cantidad' => 'required',
            'valor' => 'required',
        ]);
        // reiniciar los indices para que sean consecutivos
        $cant = [];
        foreach ($datos['cantidad'] as $key => $value) {
            if ($value != null) {
                array_push($cant, $value);
            }
        }
        $val = [];
        foreach ($datos['valor'] as $key => $value) {
            if ($value != null) {
                array_push($val, $value);
            }
        }
        //se agregan nuevos productos
        for ($i = 0; $i < sizeof($datos['prod_id']); $i++) {
            $prod_id = $datos['prod_id'][$i];
            $cantidad = $cant[$i];
            $valor = $val[$i];
            $orden_product = new Purchase_order_product([
                'purchase_order_id' => $id->id,
                'products_id' => $prod_id,
                'cantidad' => $cantidad,
                'precio' => $valor,
            ]);
            $orden_product->save();
        }
        //se buscan los productos para pasarlos a la ruta
        $orden_productos = Purchase_order_product::find($id);
        $productos = [];
        $aux2 = 0;
        foreach ($orden_productos as $key => $producto) {
            $aux = Product::find($producto->products_id);
            array_push($productos, $aux);
            //se recalcula el valor total de la orden
            $aux2 += $producto->cantidad * $producto->precio;
        }
        $total = $aux2;
        $ordenes = Purchase_order::all();
        $orden = $id;
        $orden->total = $total;
        $orden->save();
        $productosall = Product::all();
        return redirect()
            ->route('orden-compra-product-edit', ['id' => $id->id, 'orden' => $orden, 'productos' => $productos, 'productosall' => $productosall])
            ->with('success:', 'Orden actualizada correctamente.');
        $request->validate([
            'total' => 'required',
        ]);
        $ordenes = Purchase_order::all();
        $orden = $ordenes->find($id);
        $orden->total = $request->total;
        $orden->save();
        return redirect()
            ->route('orden_compra')
            ->with('success:', 'Orden actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase_order  $Purchase_order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase_order $id)
    {
        $productos = $id->product;
        foreach ($productos as $key => $producto) {
            $producto->delete();
        }
        $id->delete();
        return redirect()
            ->route('orden-compra')
            ->with('success:', 'Orden eliminada correctamente.');
    }
}
