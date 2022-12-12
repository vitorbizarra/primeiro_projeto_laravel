<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function __construct()
    {
    }

    public function principal()
    {
        return view('site.principal');
    }
}
