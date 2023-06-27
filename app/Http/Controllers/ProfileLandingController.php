<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\Section;
use App\Models\SocialNetwork;
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
        $socialnetworks = SocialNetwork::all();
        $images = Images::where('seleccionada', 1)->get();
        $sections = Section::all();
        $user = auth()->user();
        $countries = Country::all();
        $regions = Region::all();
        $cities = City::all();
        $orders = Order::where('user_id', $user->id)->get(); // Obtén los pedidos del usuario conectado

        if ($orders->isEmpty()) {
            $orders = collect(); // Inicializar como una colección vacía
            $details = collect();
            return view('profile_landing', compact('countries', 'regions', 'cities', 'user', 'orders', 'details','sections','socialnetworks','images'));
        } else {
            $details = Detail::all();
            return view('profile_landing', compact('countries', 'regions', 'cities', 'user', 'orders', 'details','sections','socialnetworks','images'));
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
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->region_fk = $request->region_fk;
        $user->city_fk = $request->city_fk;

        if ($request->hasFile('profile_image')) {
            if ($user->imagen) {
                Storage::delete('assets/images/images-profile/' . $user->imagen);
            }
            $image = $request->file('profile_image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('assets/images/images-profile'), $imageName);
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
