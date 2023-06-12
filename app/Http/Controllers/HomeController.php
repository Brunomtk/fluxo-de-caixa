<?php

namespace App\Http\Controllers;
use App\Models\Caixa;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function caixa()
    {
        return view('caixa');
    }

    public function produtos()
    {
        return view('produtos');
    }

    public function estoque()
    {
        return view('estoque');
    }

    public function graficos()
    {
        return view('graficos');
    }
}