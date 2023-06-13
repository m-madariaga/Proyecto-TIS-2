<?php

namespace App\Http\Controllers;

use App\Mail\ProofPayment;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase_order;
use App\Models\Purchase_order_product;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase_order  $Product
     */
    public function generate_pdf(Purchase_order $id)
    {
        $productos = $id->product;
        // Mail::to('fparedesp@ing.ucsc.cl')->send(new ProofPayment($users, $fecha_actual));
        $pdf = PDF::loadView('receipt.ticket', ['orden' => $id, 'productos' => $productos]);
        return $pdf->download('ticket.pdf');
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
        return view('purchase_order.create', compact('productos', 'marcas', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $request->validate(
            [
                'prod_id' => 'required',
                'cantidad' => 'required',
                'valor' => 'required',
            ],
            [
                'prod_id.required' => 'Selecciona un producto.',
                'cantidad.required' => 'El campo cantidad es obligatorio.',
                'valor.required' => 'El campo valor es obligatorio.',
            ],
        );

        $productos = $datos['prod_id'];
        // reiniciar los indices para que sean consecutivos y quitar los nulls
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
        //creamos la nueva orden para obtener su id
        $new_orden = new Purchase_order([
            'total' => 0,
        ]);
        $new_orden->save();
        //agregamos los productos
        $id = $new_orden->id;
        for ($i = 0; $i < sizeof($productos); $i++) {
            $prod_id = $datos['prod_id'][$i];
            $cantidad = $cant[$i];
            $valor = $val[$i];
            $orden_product = new Purchase_order_product([
                'purchase_order_id' => $id,
                'products_id' => $prod_id,
                'cantidad' => $cantidad,
                'precio' => $valor,
            ]);
            $orden_product->save();
        }
        //calcular total de la orden
        $orden = Purchase_order::find($id);
        $aux = 0;
        foreach ($orden->product as $prod) {
            $aux += $prod->cantidad * $prod->precio;
        }
        $total = $aux;
        $orden->total = $total;
        $orden->save();
        return redirect()->route('orden-compra');
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
        return view('purchase_order.edit', compact('orden', 'orden_productos', 'productosall'));
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
        return response()
            ->json(['success' => true]);
    }
}
