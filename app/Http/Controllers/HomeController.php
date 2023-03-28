<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function lapangan()
    {
        return view('lapangan');
    }
}
