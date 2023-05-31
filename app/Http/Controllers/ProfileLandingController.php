<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\City;
use App\Models\Region;
use App\Models\Country;
use App\Models\Order;
use App\Models\Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileLandingController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $countries = Country::all();
        $regions = Region::all();
        $cities = City::all();
        $orders = Order::where('user_id', $user->id)->get(); // Obtén los pedidos del usuario conectado

        if ($orders->isEmpty()) {
            $orders = collect(); // Inicializar como una colección vacía
            $details = collect();
            return view('profile_landing', compact('countries', 'regions', 'cities', 'user', 'orders', 'details'));
        } else {
            $details = Detail::all();
            return view('profile_landing', compact('countries', 'regions', 'cities', 'user', 'orders', 'details'));
        }


    }

    public function getRegions($countryId)
    {
        $regions = Region::where('country_fk', $countryId)->get();
        return response()->json(['regions' => $regions]);
    }

    public function getCities($regionId)
    {
        $cities = City::where('region_fk', $regionId)->get();
        return response()->json(['cities' => $cities]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $region = Region::find($request->region_fk);
        $city = City::find($request->city_fk);
        $user->region_fk = $region->name;
        $user->city_fk = $city->name;

        // Validar y guardar la imagen si se ha cargado una nueva
        if ($request->hasFile('profile_image')) {
            // Eliminar la imagen anterior si existe
            if ($user->imagen) {
                Storage::delete('assets/images/images-profile/' . $user->imagen);
            }
            $imagen = $request->file('profile_image');
            $imageName = $imagen->getClientOriginalName();

            // Guardar la nueva imagen en la carpeta 'images-profile'
            $imagen->move(public_path('assets/images/images-profile'), $imageName);

            $user->imagen = $imageName;
        }

        $user->save();
        return redirect('/profile_landing')->with('success', 'Perfil actualizado exitosamente!');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_fk');
    }
}