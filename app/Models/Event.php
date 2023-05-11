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
        'color' => 'required',
        'start' => 'required',
        'end' => 'required',
    ];
}