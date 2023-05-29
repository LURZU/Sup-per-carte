<?php

namespace App\Http\Controllers\User\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Matiere;
use App\Models\Formation;
use App\Models\Schools;
use App\Models\Roles;
use Illuminate\Support\Str;
use App\Mail\TemporaryPasswordMail;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests\ProfileUpdateRequest;

class ProfilController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('admin.users.userlist', compact('users'));
    }

    public function create()
    {
        $roles = Roles::all();
        // foreach for on all role in bdd and add in table list_roles
        $list_roles = [];
        foreach($roles as $role){
            if( $role->name === 'prof') {
                $role->name = 'Enseignant';
                $list_roles[] =  $role;
                
            } else if($role->name === 'student') {
                $role->name = 'Etudiant';
                $list_roles[] =  $role;
            }
        }

        $user = new User();
        return view('admin.users.create', ['user' => $user, 'schools' => Schools::all(), 'matieres' => Matiere::All(), 'formations' => Formation::all(), 'roles' => $list_roles]);
    }
    

    public function store(ProfileUpdateRequest $request)
    {
        // Create a new user instance
        $data = $request->validated();
        $user = new User($data);
        $user->name = $request->input('first_name') . ' ' . $request->input('last_name');
        // generate random password for user (temporary)
        $user->password = bcrypt(Str::random(8));
        if($request->input('role_id') == 2) {
            $user->matiere_id = $request->input('matiere_id');
        } else if($request->input('role_id') == 3) {
            $user->formation_id = $request->input('formation_id');
        }
    
        // Send the user a temporary password
        Mail::to($user->email)->send(new TemporaryPasswordMail($user->password));
        // Save the user
        $user->save();
        if($request->input('role_id') == 2) {
            $user->assignRole('prof');
        } else if($request->input('role_id') == 3) {
            $user->assignRole('student');
        }
        // Associate the user with the role
        $user->schools()->attach($request->input('school_id'));

        return redirect()->route('admin.profil.index')->with('success', 'Utilisateur créé avec succès.');
    }

    public function edit(User $user)
    {
        $roles = Roles::all();

        $list_roles = [];
        foreach($roles as $role){
            if( $role->name === 'prof') {
                $role->name = 'Enseignant';
                $list_roles[] =  $role;
                
            } else if($role->name === 'student') {
                $role->name = 'Etudiant';
                $list_roles[] =  $role;
            }
        }

        $user->school_id = $user->schools()->first()->id;
        dd($user->school_id);
        return view('admin.users.edit',['user' => $user, 'schools' => Schools::all(), 'formations' => Formation::all(), 'roles' => $list_roles]);
    }

    public function update(ProfileUpdateRequest $request, User $user)
    {
        // Valider les données du formulaire
        $data = $request->validated();
        $user = new User($data);
        // Mettre à jour les attributs de l'utilisateur
        $user->name = $request->input('name');
        $user->email = $request->input('email');
    
        // Mettez à jour d'autres attributs de l'utilisateur si nécessaire

        // Enregistrer les modifications dans la base de données
        $user->save();

        // Rediriger vers la page d'index des utilisateurs avec un message de succès
        return redirect()->route('admin.profil.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $user)
    {
        if(auth()->user() == $user){
            return redirect()->route('admin.profil.index')->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->schools()->detach();
        $user->roles()->detach();
        $user->delete();

        // Rediriger vers la page d'index des utilisateurs avec un message de succès
        return redirect()->route('admin.profil.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}

