<?php

namespace App\Http\Controllers\User\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminController extends Controller
{
    public function showDashboard(): View{
        return view('admin.dashboard');
    }
}
