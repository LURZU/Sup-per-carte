<?php

namespace App\Http\Controllers\User\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.accueil.accueil');
    }
}
