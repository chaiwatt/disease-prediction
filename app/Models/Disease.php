<?php

namespace App\Models;

use App\Models\Symptom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Disease extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'url'
    ];

    public function symptoms()
    {
        return $this->belongsToMany(Symptom::class, 'disease_symptoms', 'disease_id', 'symptom_id');
    }
}
