<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $query = Game::query();

        if ($request->get('genre')) {
            $query->where('genre', $request->get('genre'));
        }

        if ($request->get('platform')) {
            $query->where('platform', $request->get('platform'));
        }

        if ($request->get('search')) {
            $query->where('title', 'like', '%' . $request->get('search') . '%');
        }

        $games = $query->paginate(2);

        return view('games.index', compact('games'));
    }

    public function show(Game $game)
    {
        return view('games.show', compact('game'));
    }

    public function create()
    {
        return view('games.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'developer' => 'required',
            'genre' => 'required',
            'release_date' => 'required|date',
            'platform' => 'required',
            'price' => 'required|numeric',
        ]);

        Game::create($request->all());

        return redirect()->route('games.index');
    }

    public function edit(Game $game)
    {
        return view('games.edit', compact('game'));
    }

    public function update(Request $request, Game $game): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'developer' => 'required',
            'genre' => 'required',
            'release_date' => 'required|date',
            'platform' => 'required',
            'price' => 'required|numeric',
        ]);

        $game->update($request->all());

        return redirect()->route('games.index');
    }

    public function destroy(Game $game): RedirectResponse
    {
        $game->delete();

        return redirect()->route('games.index');
    }
}
