<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Students;
use App\Models\CardLevel;
use App\Models\CardSemestre;
use App\Models\Matiere;
use App\Models\StatusCard;
use Illuminate\Support\Facades\DB;



class Card extends Model
{
    use HasFactory;

    protected $table = 'card';

    protected $fillable = [
        'matiere_id',
        'question',
        'response',
        'public',
        'card_chapitre_id',
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

    public function getPublicCard($list_all_card) {
        $return_array = [];
        foreach ($list_all_card as $card) {
           if($card->public) {
                $return_array[] = $card;
           }
        }
        return $return_array;
    }

    public function getUnMasterCard($list_all_card) {
        $list_unmaster_card = [];
     
        foreach ($list_all_card as $card) {
            if($card->status_card_id === 1 || $card->status_card_id === 2){
                $list_unmaster_card[] = $card;
            }
        }
        return $list_unmaster_card;

    }

    public function getCardsWithoutStatus($list_all_cards)
    {
        $cardIdsWithStatus = DB::table('user_status_card')
            ->select('card_id')
            ->distinct()
            ->get()
            ->pluck('card_id')
            ->toArray();
    
        $cardsWithoutStatus = $list_all_cards->reject(function ($card) use ($cardIdsWithStatus) {
            return in_array($card->id, $cardIdsWithStatus);
        });
        return $cardsWithoutStatus;
    }

}
