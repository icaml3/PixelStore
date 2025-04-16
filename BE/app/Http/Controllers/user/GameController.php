<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Category;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::active()
            ->with('category')
            // ->get()
            ->paginate(12);

        $data = [
            'games' => $games,
        ];
        return view('user.games', $data);
    }

    public function detail($id)
    {
        $game = Game::active()
            ->with('category')
            ->findOrFail($id);
        $data = [
            'game' => $game
        ];
        return view('user.game-detail', $data);
    }

    public function category($category_id)
    {
        $games = Game::active()
            ->with('category')
            ->where('games.category_id', $category_id)
            // ->get();
            ->paginate(12);


        $categories = Category::all();
        $data = [
            'games' => $games,
            'categories' => $categories,
            'category_id' => $category_id
        ];
        return view('user.games', $data);
    }

    public function search(Request $request){
        $search = $request->input('query');
        $games = Game::active()
            ->with('category')
            ->where('name', 'like', "%$search%")
            ->orWhere('short_description', 'LIKE', "%{$search}%")
            ->orWhere('detailed_description', 'LIKE', "%{$search}%")
            ->get();
        $data = [
            'games' => $games,
            'search' => $search
        ];
        return view('user.gamessearch', $data);
    }
}
