<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KamatiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the Kamati za Chuo PDF viewer page.
     */
    public function index()
    {
        return view('admin.kamati.index');
    }
}
