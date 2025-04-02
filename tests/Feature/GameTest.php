<?php

namespace Tests\Feature;

use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GameTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_game()
    {
        Storage::fake('public');

        $data = [
            'title' => 'Test Game',
            'developer' => 'Test Developer',
            'genre' => 'Action',
            'release_date' => '2023-04-02',
            'platform' => 'PC',
            'price' => 19.99,
            'cover_image' => UploadedFile::fake()->image('cover.jpg'),
        ];

        $this->withoutMiddleware();
        $response = $this->post(route('games.store'), $data);

        $response->assertRedirect(route('games.index'));
        $this->assertDatabaseHas('games', [
            'title' => 'Test Game',
            'cover_image' => 'games/' . $data['cover_image']->hashName(),
        ]);
    }

    /** @test */
    public function it_can_update_a_game()
    {
        $game = Game::factory()->create();

        Storage::fake('public');
        $oldCoverImage = $game->cover_image;

        $data = [
            'title' => 'Updated Game',
            'developer' => 'Updated Developer',
            'genre' => 'RPG',
            'release_date' => '2023-05-05',
            'platform' => 'PlayStation',
            'price' => 49.99,
            'cover_image' => UploadedFile::fake()->image('updated_cover.jpg'),
        ];

        $this->withoutMiddleware();

        $response = $this->put(route('games.update', $game->id), $data);

        Storage::disk('public')->assertMissing('games/' . $oldCoverImage);
        Storage::disk('public')->assertExists('games/' . $data['cover_image']->hashName());

        $response->assertRedirect(route('games.index'));
        $this->assertDatabaseHas('games', [
            'title' => 'Updated Game',
            'developer' => 'Updated Developer',
            'genre' => 'RPG',
            'release_date' => '2023-05-05',
            'platform' => 'PlayStation',
            'price' => 49.99,
            'cover_image' => 'games/' . $data['cover_image']->hashName(),
        ]);
    }

    /** @test */
    public function it_can_delete_a_game()
    {
        $game = Game::factory()->create();

        $this->withoutMiddleware();

        $response = $this->delete(route('games.destroy', $game->id));

        $response->assertRedirect(route('games.index'));
        $this->assertDatabaseMissing('games', ['id' => $game->id]);
    }
}
