<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\Country;
class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country_fk',

    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function cities()
    {
        return $this->hasMany(City::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_fk');
    }
}
