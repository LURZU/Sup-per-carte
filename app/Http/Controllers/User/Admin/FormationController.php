<?php

namespace App\Http\Controllers\User\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formation;

class FormationController extends Controller
{
    public function index()
    {
        if(@auth()->user()->hasRole('admin')) {
            
         return view('admin.formation.index', ['formations' => Formation::all()]);
        } else {
            return redirect()->route('dashboard');
        }
    }
}
