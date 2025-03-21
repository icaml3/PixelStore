<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Category;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::active()
            ->with('category')
            ->get();

        $data = [
            'games' => $games,
        ];
        return view('games', $data);
    }

    public function detail($id)
    {
        $game = Game::active()
            ->with('category')
            ->findOrFail($id);
        $data = [
            'game' => $game
        ];
        return view('game-detail', $data);
    }

    public function category($category_id)
    {
        $games = Game::active()
            ->with('category')
            ->where('games.category_id', $category_id)
            ->get();

        $categories = Category::all();
        $data = [
            'games' => $games,
            'categories' => $categories,
            'category_id' => $category_id
        ];
        return view('games', $data);
    }
}
