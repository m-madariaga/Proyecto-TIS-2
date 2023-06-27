<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromotionController extends Controller
{
    public function index()
    {
        $promociones = Promotion::all();
        return view('promotion.index', compact('promociones'));
    }
    public function create()
    {
        $productos = Product::all();
        return view('promotion.create', compact('productos'));
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'prod_id' => 'required',
                'descuento' => 'required',
            ],
            [
                'prod_id.required' => 'Selecciona un producto.',
                'descuento.required' => 'El campo descuento es obligatorio.',
            ],
        );
        $productos = $request->get('prod_id');
        // reiniciar los indices para que sean consecutivos y quitar los nulls
        $descuentos = [];
        foreach ($request->get('descuento') as $key => $value) {
            if ($value != null) {
                array_push($descuentos, $value);
            }
        }
        //guardamos la promocion
        for ($i = 0; $i < sizeof($productos); $i++) {
            $prod_id = $productos[$i];
            $descuento = $descuentos[$i];
            $promocion = new Promotion([
                'product_id' => $prod_id,
                'descuento' => $descuento,
            ]);
            $promocion->save();
            //actualizamos el precio en el producto
            $product = Product::find($promocion->product_id);
            $product->precio = $product->precio - $promocion->descuento;
            $product->save();
        }

        //se registra el accion realizada
        $action = new Action();
        $action->name = 'Creación Orden de Compra';
        $action->user_fk = Auth::User()->id;
        $action->save();
        return redirect()
            ->route('promotion')
            ->with('success', 'Promoción agregada correctamente.');
    }
    public function edit(Promotion $id)
    {
        $promocion = Promotion::find($id->id);
        return view('promotion.edit', compact('promocion'));
    }
    public function update(Request $request)
    {
        $request->validate(
            [
                'prod_id' => 'required',
                'descuento' => 'required',
            ],
            [
                'prod_id.required' => 'Selecciona un producto.',
                'descuento.required' => 'El campo descuento es obligatorio.',
            ],
        );
        //actualiza el descuento de la promocion
        $promocion = Promotion::find($request->get('prod_id'));
        //guardamos el descuento anterior
        $descuento_anterior = $promocion->descuento;
        //actualizamos el nuevo descuento
        $promocion->descuento = $request->get('descuento');
        $promocion->save();
        //actualiza el precio del producto
        $product = Product::find($promocion->product_id);
        $product->precio = $product->precio + $descuento_anterior - $promocion->descuento;
        return redirect()->route('promotion')->with('success','Promoción editada correctamente.');
    }
    public function destroy(Promotion $id)
    {
        //busca la promocion a eliminar
        $promocion = Promotion::find($id->id);
        //busca el producto para actualizar su precio (sumar el descuento hecho)
        $product = Product::find($promocion->product_id);
        $product->precio = $product->precio + $promocion->descuento;
        $product->save();
        //eliminar promocion
        $promocion->delete();
        return redirect()
            ->route('promotion')
            ->with('success', 'Promoción eliminada correctamente.');
    }
}
