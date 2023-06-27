<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frequent_response extends Model
{
    use HasFactory;

    protected $fillable = [
        'respuesta',
        'frequent_question_id',
    ];

    public function frequent_question()
    {
        return $this->belongsTo(Frequent_question::class, 'frequent_question_id');
    }
}