<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Country;
use App\Models\Action;
use Illuminate\Support\Facades\Auth;

class RegionController extends Controller
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
        return view('regions.index', compact('regions','countries'));
    }
    public function getRegions($countryId)
    {
        $regions = Region::where('country_fk', $countryId)->get();
        return response()->json($regions);
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

            ]);

            $region = Region::create($validatedData);

            $action = new Action();
                $action->name = 'Creación Región';
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
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'name' => 'required|string|max:56',
            'country_fk' => 'required',
        ]);

        $region = Region::find($id);

        $region->name = $request->get('name');
        $region->country_fk = $request->get('country_fk');

        $region->save();

        $action = new Action();
            $action->name = 'Edición Región';
            $action->user_fk = Auth::User()->id;
        $action->save();


        return redirect('admin/regions')->with('success', 'Pais actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region= Region::find($id);
        $region->delete();

        $action = new Action();
            $action->name = 'Borrado Región';
            $action->user_fk = Auth::User()->id;
        $action->save();
        
        return response()->json(['success' => true]);
    }
}
