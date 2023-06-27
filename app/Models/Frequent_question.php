<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frequent_question extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'pregunta',
    ];
    
    public function response()
    {
        return $this->hasMany(Frequent_response::class, 'frequent_question_id');
    }
}
