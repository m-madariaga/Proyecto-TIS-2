<?php

namespace App\Models;
use App\Models\WebpayCredential;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'run',
        'address',
        'phone_number',
        'city_fk',
        'country_fk',
        'region_fk',
        'imagen',
    ];
    public function roleName()
    {
        $role = $this->roles->first();
        return $role ? $role->name : null;
    }
    public function orders()
    {
        return $this->belongsTo(Order::class, 'user_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_fk');
    }

    public function region()
    {
        return $this->belongsTo(Region::class,'region_fk');
    }
    public function shipments()
    {
        return $this->hasMany(Shipment::class,'user_fk');
    }
    public function country()
    {
        return $this->belongsTo(Country::class,'country_fk');
    }
    public function product_desired(): HasMany
    {
        return $this->hasMany(Product_desired::class, 'user_id');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function webpayCredential(): HasOne
    {
        return $this->hasOne(WebpayCredential::class, 'user_id');
    }

}
