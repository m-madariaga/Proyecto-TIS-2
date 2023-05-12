<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\Region;
class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',

    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class);
    }
    public function regions()
    {
        return $this->hasMany(Region::class);
    }
}
