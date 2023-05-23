<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\City;
use App\Models\Region;
use App\Models\Country;
use Illuminate\Http\Request;

class ProfileLandingController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        $regions = Region::all();
        $cities = City::all();
        return view('profile_landing', compact('countries', 'regions', 'cities'));
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
        $region = Region::find($request->region_fk);
        $city = City::find($request->city_fk);
        $user->region_fk = $region->name;
        $user->city_fk = $city->name;


        $user->save();
        return redirect('/profile_landing')->with('success', 'Permiso actualizado exitosamente!');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_fk');
    }
}
