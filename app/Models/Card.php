<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Students;
use App\Models\CardLevel;
use App\Models\CardSemestre;
use App\Models\Matiere;
use App\Models\StatusCard;


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

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function cardLevel()
    {
        return $this->belongsTo(CardLevel::class);
    }

    public function cardSemestre() 
    {
        return $this->belongsTo(CardSemestre::class);
    }

    public function getPrivateCard($list_all_card) {
        return 'test'; 
    }

    public function getCardStatus($card, $user_id) {
            $allstatus = StatusCard::all();
            $card->status_card_id = where('id', $card->card_id)->where('id', $user_id )->get();
            
        return $card;
    }

}
