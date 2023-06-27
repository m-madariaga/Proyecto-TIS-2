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
        }
        $action = new Action();
        $action->name = 'Creación Orden de Compra';
        $action->user_fk = Auth::User()->id;
        $action->save();
        return redirect()
            ->route('promotion')
            ->with('success', 'Promocion agregada correctamente.');
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
        $promocion = Promotion::find($request->get('prod_id'));
        $promocion->descuento = $request->get('descuento');
        $promocion->save();
        return redirect()->route('promotion')->with('success','Promocion editada correctamente.');
    }
    public function destroy(Promotion $id)
    {
        $promocion = Promotion::find($id->id);
        $promocion->delete();
        return redirect()
            ->route('promotion')
            ->with('success', 'Promocion eliminada correctamente.');
    }
}
