<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start',
        'color',
        'end',
    ];

    public static $rules = [
        'title' => 'required',
        'description' => 'required',
        'start' => 'required|date',
        'end' => 'required|date',
        'color' => 'required',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
