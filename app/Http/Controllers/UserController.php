<?php

namespace App\Http\Controllers;

use App\Mail\ProofPayment;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use Spatie\Permission\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use App\Models\Action;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
        $users = User::all();
        $roles = Role::all();
        return view('users.index', compact('users', 'roles', 'countries', 'cities', 'regions'));
    }

    public function profile_argon()
    {
        error_log('intro profile_argon');
        $users = User::all();
        return view('profile', compact('users'));
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
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'phone_number' => 'required|string|min:9|regex:/^9[0-9]{8}$/',
                'password' => 'required|string|min:8',
                'run' => 'required|string|unique:users|regex:/^\d{7,8}-[0-9K]$/',
                'address' => 'required|string',
                'city_fk' => 'required|exists:cities,id',
                'country_fk' => 'required|exists:countries,id',
                'region_fk' => 'required|exists:regions,id',
            ]);

            $user = User::create($validatedData);
            $user->assignRole($request->input('role'));

            $action = new Action();
                $action->name = 'Creación Usuario';
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::find($id);




        return response(view('users.edit', compact('users')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $roles = $user->getRoleNames();
        error_log($roles);

        $user->syncRoles($request->get('role'));
        error_log($roles);
        $user->save();

        $action = new Action();
            $action->name = 'Edición Usuario';
            $action->user_fk = Auth::User()->id;
        $action->save();

        return redirect('admin/users')->with('success', 'Usuario actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        $action = new Action();
            $action->name = 'Borrado Usuario';
            $action->user_fk = Auth::User()->id;
        $action->save();

        // dejar para futuro sweetalert return response()->json(['success' => true]);

        return response()->json(['success' => true]);
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
