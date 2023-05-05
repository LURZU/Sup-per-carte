<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Students;

class Card extends Model
{
    use HasFactory;

    protected $table = 'card';

    protected $fillable = [
        'matiere_id',
        'question',
        'response',
        'public',
        'card_chapitre',
        'card_level_id',
        'card_semestre_id',
        'createdBy',
        'ValidatedBy',
    ];


}
