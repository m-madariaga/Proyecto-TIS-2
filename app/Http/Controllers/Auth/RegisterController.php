<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'run' => ['required', 'unique:users', 'regex:/^\d{7,8}-[0-9K]$/'],
            'address' => ['required', 'string'],
            'city_fk' => ['required', 'string'],
            'region_fk' => ['required', 'string'],
            'phone_number' => ['required', 'string', 'min:9', 'regex:/^9[0-9]{8}$/'],
            'country_fk' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'run' => $data['run'],
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'city_fk' => $data['city_fk'],
            'region_fk' => $data['region_fk'],
            'country_fk' => $data['country_fk'],
            'imagen' => 'perfil-de-usuario.png', 
        ]);

        $user->assignRole('cliente');

        return $user;
    }

    public function showRegistrationForm()
    {
        $countries = Country::all();
        $regions = Region::all();
        $cities = City::all();
        return view('auth.register', compact('cities', 'regions', 'countries'));
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
