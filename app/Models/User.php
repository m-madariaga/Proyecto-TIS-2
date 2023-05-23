<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;


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
        'city_fk',
        'country_fk',
        'region_fk',
    ];
    public function roleName()
    {
        $role = $this->roles->first();
        return $role ? $role->name : null;
    }
    public function orders()
    {
        return $this->belongsTo(Order::class, 'id');
    }
    
    public function city()
    {
        return $this->belongsTo(City::class,'city_fk');
    }

    public function region()
    {
        return $this->belongsTo(Region::class,'region_fk');
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'country_fk');
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
}
