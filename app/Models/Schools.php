<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schools extends Model
{
    use HasFactory;
    protected $table = 'schools';

    public function school_user()
    {
        return $this->belongsToMany(User::class, 'school_user', 'school_id', 'user_id');
    }

    public function getSchool($list_card_all) {
        
        foreach ($list_card_all as $card) {
            if($card->matiere_id !== null){
                $card->matiere = $this->where('id', $card->matiere_id)->first()->label;
            }
  
        }
        return $list_card_all;
    }

}
