<!-- resources/views/games/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6 bg-white justify-center shadow-md rounded-lg">
        <div class="flex items-center mb-6">
            <h1 class="text-3xl flex-1 font-bold text-center">Game Catalog</h1>
            <a href="{{ route('games.create') }}" class="ml-auto px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Add New Game</a>
        </div>

        <form method="GET" action="{{ route('games.index') }}" class="mb-6 flex flex-wrap gap-4 items-center">
            <input type="text" name="search" placeholder="Search by title"
                   value="{{ request('search') }}"
                   class="p-2 border rounded w-1/3" />

            <select name="genre" class="p-2 border rounded w-1/4">
                <option value="">All Genres</option>
                <option value="Action" {{ request('genre') == 'Action' ? 'selected' : '' }}>Action</option>
                <option value="RPG" {{ request('genre') == 'RPG' ? 'selected' : '' }}>RPG</option>
                <option value="Shooter" {{ request('genre') == 'Shooter' ? 'selected' : '' }}>Shooter</option>
                <option value="Adventure" {{ request('genre') == 'Adventure' ? 'selected' : '' }}>Adventure</option>
            </select>

            <select name="platform" class="p-2 border rounded w-1/4">
                <option value="">All Platforms</option>
                <option value="PC" {{ request('platform') == 'PC' ? 'selected' : '' }}>PC</option>
                <option value="PlayStation" {{ request('platform') == 'PlayStation' ? 'selected' : '' }}>PlayStation</option>
                <option value="Xbox" {{ request('platform') == 'Xbox' ? 'selected' : '' }}>Xbox</option>
                <option value="Nintendo" {{ request('platform') == 'Nintendo' ? 'selected' : '' }}>Nintendo</option>
            </select>

            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Filter</button>
            <a href="{{ route('games.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Reset</a>
        </form>

        <table class="w-full border-collapse border border-gray-300 text-left">
            <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 p-2">Title</th>
                <th class="border border-gray-300 p-2">Developer</th>
                <th class="border border-gray-300 p-2">Genre</th>
                <th class="border border-gray-300 p-2">Release Date</th>
                <th class="border border-gray-300 p-2">Platform</th>
                <th class="border border-gray-300 p-2">Price</th>
                <th class="border border-gray-300 p-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($games as $game)
                <tr class="border border-gray-300">
                    <td class="p-2">{{ $game->title }}</td>
                    <td class="p-2">{{ $game->developer }}</td>
                    <td class="p-2">{{ $game->genre }}</td>
                    <td class="p-2">{{ $game->release_date->format('d.m.Y') }}</td>
                    <td class="p-2">{{ $game->platform }}</td>
                    <td class="p-2">
                        @if ($game->price != 0)
                            ${{ number_format($game->price, 2) }}
                        @else
                            Free
                        @endif
                    </td>
                    <td class="p-2">
                        <a href="{{ route('games.show', $game->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Details</a>
                        <a href="{{ route('games.edit', $game->id) }}" class="px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">Edit</a>
                        <form action="{{ route('games.destroy', $game->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $games->links() }}
        </div>
    </div>
@endsection
