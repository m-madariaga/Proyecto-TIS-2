<?php

namespace App\Http\Controllers;

use app\Models\User;
use App\Models\City;
use App\Models\Region;
use App\Models\Country;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->address = $request->address;
        $user->save();
        return redirect('/profile')->with('success', 'Permiso actualizado exitosamente!');
    }

    public function index()
    {
        $countries = Country::all();
        $regions = Region::all();
        $cities = City::all();
        return view('profile', compact('cities', 'regions', 'countries'));
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
}
