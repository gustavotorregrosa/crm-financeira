<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalistaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verificaperfil:analista');
    }

    public function index()
    {
        return view('analista.index');
    }
}
