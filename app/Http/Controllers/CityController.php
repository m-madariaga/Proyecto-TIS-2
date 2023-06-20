<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Country;
use App\Models\Action;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all();
        $regions = Region::all();
        $cities = City::all();
        return view('cities.index', compact('cities', 'regions', 'countries'));
    }
    public function getCities($regionId)
    {
        $cities = City::where('region_fk', $regionId)->get();
        return response()->json($cities);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $validatedData = $request->validate([
                'name' => 'required|unique:regions|string|max:100',
                'country_fk' => 'required|exists:countries,id',
                'region_fk' => 'required|exists:regions,id'

            ]);

            $city = City::create($validatedData);

            $action = new Action();
                $action->name = 'Creación Ciudad';
                $action->user_fk = Auth::User()->id;
            $action->save();



            return response()->json(['success' => true]);
        }
        catch (ValidationException $e)
        {
            $errors = $e->errors();
            return response()->json(['success' => false, 'errors' => $errors]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'name' => 'required|string|max:56',
            'country_fk' => 'required',
            'region_fk' => 'required',
        ]);

        $city = Region::find($id);

        $city->name = $request->get('name');
        $city->region_fk = $request->get('region_fk');
        $city->country_fk = $request->get('country_fk');
        $city->save();

        $action = new Action();
            $action->name = 'Edición Ciudad';
            $action->user_fk = Auth::User()->id;
        $action->save();


        return redirect('admin/cities')->with('success', 'ciudad actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::find($id);
        $city->delete();

        $action = new Action();
            $action->name = 'Borrado Ciudad';
            $action->user_fk = Auth::User()->id;
        $action->save();
        
        return response()->json(['success' => true]);

    }
}
