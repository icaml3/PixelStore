<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Game;

class HomeController extends Controller
{
    public function index()
    {
        // $games = Game::active()
        // ->with('category')->get();
        // $data = [
        //     'games' => $games,
        // ];
        return view('admin.home');
    }
}
