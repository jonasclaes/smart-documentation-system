<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

class LogController extends Controller
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
     * @return Renderable
     */
    public function index()
    {
        $logFile = file(storage_path().'/logs/laravel.log');
        $logFile = array_reverse(array_slice($logFile, -500));

        return view('logs.logs', ['logFile' => $logFile]);
    }
}
