<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Region;
use App\Models\Country;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
    'name',

    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_fk');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_fk');
    }
}
