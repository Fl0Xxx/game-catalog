<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Seeder;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Game::create([
            'title' => 'The Witcher 3: Wild Hunt',
            'developer' => 'CD Projekt Red',
            'genre' => 'RPG',
            'release_date' => '2015-05-19',
            'platform' => 'PC',
            'price' => 39.99,
        ]);

        Game::create([
            'title' => 'God of War',
            'developer' => 'Santa Monica Studio',
            'genre' => 'Action-Adventure',
            'release_date' => '2018-04-20',
            'platform' => 'PlayStation',
            'price' => 49.99,
        ]);

        Game::create([
            'title' => 'Hearthstone',
            'developer' => 'Blizzard',
            'genre' => 'DCCG',
            'release_date' => '2014-03-11',
            'platform' => 'Android',
            'price' => 0,
        ]);
    }
}
