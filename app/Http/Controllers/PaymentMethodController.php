<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::all(); // Obtener todos los métodos de pago desde la base de datos

        return view('paymentmethod_landing', compact('paymentMethods')); // Pasar la variable $paymentMethods a la vista
    }

    public function index_admin()
    {
        $paymentMethods = PaymentMethod::all(); // Obtener todos los métodos de pago desde la base de datos

        return view('paymentmethods', compact('paymentMethods')); // Pasar la variable $paymentMethods a la vista
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createpaymethod');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_landing(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $paymentMethod = new PaymentMethod;
        $paymentMethod->name = $request->name;
        $paymentMethod->save();

        return redirect('/paymentmethod')->with('success', 'Método de pago creado exitosamente!');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Establece las reglas de validación para la imagen
        ]);

        // Procesa la imagen
        if ($request->hasFile('image')) {
            $imagen = $request->file('image');
            $imageName = $imagen->getClientOriginalName(); 
        
            $imagen->move(public_path('argon/assets/img/images-paymethods'), $imageName);
        
            // Guard the image path in the database
            $paymentMethod = new PaymentMethod;
            $paymentMethod->name = $request->name;
            $paymentMethod->imagen = $imageName;
            $paymentMethod->save();
        } else {
            // Maneja el caso en que no se cargó una imagen
        }

        return redirect('/admin/paymentmethod')->with('success', 'Método de pago creado exitosamente!');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentMethod = PaymentMethod::find($id);
        $paymentMethod->delete();

        return redirect('/admin/paymentmethod')->with('success', 'Método de pago eliminado exitosamente!');

    }

}