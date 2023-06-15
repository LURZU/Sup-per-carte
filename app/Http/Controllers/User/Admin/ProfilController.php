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
        if(auth()->user()->hasRole('admin')) {
            $users = User::all();
            $users_role = User::getRoles($users);
            $users_role = User::getFormation($users_role);
            $users_role = User::getRoles($users_role);
            return view('admin.users.userlist', compact('users_role'));
        } else {
            return redirect()->route('dashboard');
        }

    }

    public function create()
    {
        $roles = Roles::all();
        // foreach for on all role in bdd and add in table list_roles
        $list_roles = [];
        foreach($roles as $role){

            //FIXME: Capitalize on CSS on display because changing the property value can causes conflicts after (there is more places with the same)
            if( $role->name === 'enseignant') {
                $role->name = 'Enseignant';
                $list_roles[] =  $role;

            } else if($role->name === 'etudiant') {
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
        if($request->input('role_id') == 3) {
            $user->formation_id = $request->input('formation_id');
        }

        // FIXME: Send the user a temporary password (disabling this until mail is configured on env)
        //Mail::to($user->email)->send(new TemporaryPasswordMail($user->password));

        // Save the user
        $user->save();
        if($request->input('role_id') == 2) {
            foreach($request->input('matiere_id') as $matiere) {
                $user->matieres()->attach($matiere);
            }
            $user->assignRole('enseignant');
        } else if($request->input('role_id') == 3) {
            $user->assignRole('etudiant');
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
            if( $role->name === 'enseignant') {
                $role->name = 'Enseignant';
                $list_roles[] =  $role;

            } else if($role->name === 'etudiant') {
                $role->name = 'Etudiant';
                $list_roles[] =  $role;
            }
        }

        if($user->hasRole('etudiant')) {
            $user->formation_id = $user->formation()->first()->id;
            if(!isset($user->schools()->first()->id)) {
                $user->school_id = 1;
            } else {
                $user->school_id = $user->schools()->first()->id;
            }
            return view('admin.users.edit',['user' => $user,'roles' => $list_roles ]);
        } else if($user->hasRole('enseignant')) {
            $matiere_ids = $user->matieres()->pluck('id')->toArray();
            return view('admin.users.edit', ['user' => $user, 'roles' => $list_roles, 'matieres' => $matiere_ids]);
        }

        if($user->hasRole('admin')) {
            return view('admin.users.edit',['user' => $user, 'schools' => Schools::all()]);
        } else {
            $user->school_id = $user->schools()->first()->id;
        }
        


        return view('admin.users.edit',['user' => $user, 'schools' => Schools::all()]);
    }

    public function update(ProfileUpdateRequest $request, User $user)
    {
       dd($request->all());
        // Valider les données du formulaire
        $data = $request->validated();
        $user = new User($data);

        $user->name = $request->input('name');
        //FIXME: can't update user because of error on form: The email has already been taken.
        if($user->email !== $request->input('email') ) {
            $user->email = $request->input('email');
        }
    

        $user->save();

        // Redirect to the users.index view and display message
        return redirect()->route('admin.profil.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $user)
    {
        if(auth()->user() == $user){
            return redirect()->route('admin.profil.index')->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->schools()->detach();
        $user->matieres()->detach();
        $user->roles()->detach();

        if($user->formation_id !== null) {
            $user->formation()->detach();
        } else {
            $user->matieres()->detach();
        }

        $user->delete();

        // Rediriger vers la page d'index des utilisateurs avec un message de succès
        return redirect()->route('admin.profil.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}

