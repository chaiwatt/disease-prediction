<?php

namespace App\Models;

use App\Models\Symptom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Phrase extends Model
{
    use HasFactory;
    protected $fillable = [
        'symptom_id',
        'phrase'
    ];

    public function symptom()
    {
        return $this->belongsTo(Symptom::class, 'symptom_id');
    }
}

