<?php

namespace App\Models;

use App\Models\WordType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WordBank extends Model
{
    use HasFactory;
    protected $fillable = [
        'word_type_id',
        'word'
    ];

    public function wordType()
    {
        return $this->belongsTo(WordType::class, 'word_type_id');
    }
}
