<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapitre extends Model
{
    use HasFactory;
    protected $table = 'chapitre';

    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'chapitre_matiere');
    }

    public function chapitre_matiere()
    {
        return $this->belongsToMany(Matiere::class, 'chapitre_matiere', 'matiere_id', 'chapitre_id');
    }

    public function getChapitresByMatiere($matiere_id)
    {
        $matiere = Matiere::findOrFail($matiere_id);
        $chapitres = $matiere->chapitres;
        return $chapitres;
    }


    public function getChapitre($list_card_all) {
            foreach ($list_card_all as $card) {
                $card->chapitre = $this->where('id', $card->card_chapitre_id)->first()->label;
            }

            return $list_card_all;
        } 
}
