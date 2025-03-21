<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Game;

class HomeController extends Controller
{
    public function index()
    {
        $games = Game::active()
        ->limit(12)
        ->with('category')->get();
        $data = [
            'games' => $games,
        ];
        return view('user.home', $data);
    }
}
