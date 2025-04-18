<!-- resources/views/games/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-lg">

        @if ($game->cover_image)
            <div class="mt-4">
                <img src="{{ asset('storage/' . $game->cover_image) }}" alt="Cover Image" class="w-120 h-72 object-cover mt-2 rounded-md">
            </div>
        @endif

        <h1 class="text-2xl font-bold mb-4">{{ $game->title }}</h1>

        <p><strong>Developer:</strong> {{ $game->developer }}</p>
        <p><strong>Genre:</strong> {{ $game->genre }}</p>
        <p><strong>Release Date:</strong> {{ $game->release_date->format('d.m.Y') }}</p>
        <p><strong>Platform:</strong> {{ $game->platform }}</p>
        <p><strong>Price:</strong>
            @if ($game->price != 0)
                ${{ number_format($game->price, 2) }}
            @else
                Free
            @endif
        </p>

        <a href="{{ route('games.index') }}" class="inline-block mt-4 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Back</a>
    </div>
@endsection
