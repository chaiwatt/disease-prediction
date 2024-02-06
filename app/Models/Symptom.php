<?php

namespace App\Models;

use App\Models\Phrase;
use App\Models\Disease;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Symptom extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'intent',
        'training_phrase'
    ];

  
    public function diseases()
    {
        return $this->belongsToMany(Disease::class, 'disease_symptoms', 'symptom_id', 'disease_id');
    }

      public function phrases()
    {
        return $this->hasMany(Phrase::class, 'symptom_id');
    }

}
