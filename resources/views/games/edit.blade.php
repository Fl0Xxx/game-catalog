<!-- resources/views/games/edit.blade.php -->

<h1>Edit Game</h1>

<form action="{{ route('games.update', $game->id) }}" method="POST">
    @csrf
    @method('PUT')
    <label for="title">Title</label>
    <input type="text" name="title" id="title" value="{{ $game->title }}" required>
    <label for="developer">Developer</label>
    <input type="text" name="developer" id="developer" value="{{ $game->developer }}" required>
    <label for="genre">Genre</label>
    <input type="text" name="genre" id="genre" value="{{ $game->genre }}" required>
    <label for="release_date">Release Date</label>
    <input type="date" name="release_date" id="release_date" value="{{ $game->release_date }}" required>
    <label for="platform">Platform</label>
    <input type="text" name="platform" id="platform" value="{{ $game->platform }}" required>
    <label for="price">Price</label>
    <input type="text" name="price" id="price" value="{{ $game->price }}" required>
    <button type="submit">Save</button>
</form>
