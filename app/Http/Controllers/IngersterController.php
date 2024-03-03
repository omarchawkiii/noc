<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IngersterController extends Controller
{

    public function index()
    {
        return view('ingester.index');
    }
}
