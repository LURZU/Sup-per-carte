<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasRoles;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'formation_id',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function favorites()
    {
        return $this->belongsToMany(Card::class, 'student_card_fav', 'user_id', 'card_id');
    }

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    //to use this function, use getRoles($users) in controller
    public function getMatiereListAttribute($user)
    {
        if ($user->role_name === 'enseignant') {
            $user->matieres_list = $this->matieres()->pluck('label')->toArray();
        }
    }
    
    public function matieres()
    {
        return $this->belongsToMany(Matiere::class, 'matiere_user', 'user_id', 'matiere_id');
    }


    public function card_status_user()
    {
        return $this->belongsToMany(Card::class, 'user_status_card', 'user_id', 'card_id');
    }

    public function schools()
    {
        return $this->belongsToMany(Schools::class, 'school_user', 'user_id', 'school_id');
    }

    public function getCardStatus($list_all_cards, $user_id) {
        //Query to obtain the status of card with join 3 tables 
        foreach($list_all_cards as $card) {
            $query = $this->join('user_status_card', 'users.id', '=', 'user_status_card.user_id')
            ->join('card', 'user_status_card.card_id', '=', 'card.id')
            ->join('status_card', 'user_status_card.status_card_id', '=', 'status_card.id')
            ->select('status_card.id', 'status_card.label', 'user_status_card.user_id')
            ->where('users.id', $user_id)
            ->where('card.id', $card->id)
            ->first();
            $card->auth_id_user = $query->user_id;
            $card->status_card = $query->label;
            $card->status_card_id = $query->id;
        }
        return $list_all_cards;
    }

    public static function getFormation($users)
    {
            foreach($users as $user) {
                if($user->formation_id) {
                $user->formation = User::where('id', $user->formation_id)->first()->formation->label;
                } else {
                    $user->formation = null;
                }
            return $users;
        }
       
    }

    public static function getRoles($users)
    {
        $roles = Roles::all();
        foreach ($users as $user) {
            $userRole = $user->roles->first();
            if ($userRole) {
                // Trouver le rôle correspondant dans la liste des rôles
                $role = $roles->firstWhere('name', $userRole->name);
            

                // Définir la valeur du rôle (nom et ID) pour l'utilisateur
                $user->role_name = $role ? $role->name : null;
                $user->role_id = $role ? $role->id : null;
            }
        }
        return $users;
    }


    
    public function hasRole($role): bool {
        if($this->roles()->first()->name === $role) {
            return true;
        }
        return false;
    }

    
}
