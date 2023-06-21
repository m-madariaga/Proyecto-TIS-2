<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WebpayCredential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class WebpayCredentialController extends Controller
{
    public function index()
    {
        $webpayCredentials = WebpayCredential::all();
        return view('webpaycredentials.index', compact('webpayCredentials'));
    }

    public function create()
    {
        $user = auth()->user();
        $userId = $user->id;
        $userName = $user->name;

        return view('webpaycredentials.create', compact('userId', 'userName'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'commerce_code' => 'required',
            'api_key' => 'required',
            'integration_type' => 'required',
            'environment' => 'required',
            'user_id' => 'required',
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        WebpayCredential::create($validatedData);

        return redirect()->route('webpaycredentials.index')->with('success', 'Credencial de WebPay creada exitosamente.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'commerce_code' => 'required',
            'api_key' => 'required',
            'integration_type' => 'required',
            'environment' => 'required',
            'user_id' => 'required',
        ]);

        $webpayCredential = WebpayCredential::findOrFail($id);
        $webpayCredential->update($validatedData);

        return redirect()->route('webpaycredentials.index')->with('success', 'Credencial de WebPay actualizada exitosamente.');
    }

    public function edit($id)
    {
        $webpayCredential = WebpayCredential::findOrFail($id);
        $users = User::all(); // Obtener todos los usuarios disponibles
        return view('webpaycredentials.edit', compact('webpayCredential', 'users'));
    }

    public function destroy($id)
    {
        $webpayCredential = WebpayCredential::findOrFail($id);
        $webpayCredential->delete();
        return response()->json(['success' => true]);
    }

   
}
