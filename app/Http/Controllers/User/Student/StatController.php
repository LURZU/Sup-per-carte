<?php

namespace App\Http\Controllers\User\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatController extends Controller
{
    public function index()
    {
        return view('student.stats.index');
    }
}
