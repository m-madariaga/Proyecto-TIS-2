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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'run' => ['required', 'unique:users','regex:/^\d{7,8}-[0-9K]$/'],
            'nombreCalle' => ['required', 'string'],
            'numeroCalle' => ['required', 'string'],
            'city' => ['required', 'string'],
            'region' => ['required', 'string'],
            'country' => ['required', 'string'],
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
    $city = City::findOrFail($data['city']);
    $region = $city->region;
    $country = $region->country;

    return User::create([
        'run' => $data['run'],
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'city_fk' => $city->id,
        'region_fk' => $region->id,
        'country_fk' => $country->id,
    ]);

}
}
