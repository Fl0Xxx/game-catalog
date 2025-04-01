<!-- resources/views/games/create.blade.php -->

<h1>Add New Game</h1>

<form action="{{ route('games.store') }}" method="POST">
    @csrf
    <label for="title">Title</label>
    <input type="text" name="title" id="title" required>
    <label for="developer">Developer</label>
    <input type="text" name="developer" id="developer" required>
    <label for="genre">Genre</label>
    <input type="text" name="genre" id="genre" required>
    <label for="release_date">Release Date</label>
    <input type="date" name="release_date" id="release_date" required>
    <label for="platform">Platform</label>
    <input type="text" name="platform" id="platform" required>
    <label for="price">Price</label>
    <input type="text" name="price" id="price" required>
    <button type="submit">Save</button>
</form>
