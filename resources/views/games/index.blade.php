<!-- resources/views/games/index.blade.php -->

<h1>Games</h1>
<a href="{{ route('games.create') }}">Add New Game</a>

<table>
    <thead>
    <tr>
        <th>Title</th>
        <th>Developer</th>
        <th>Genre</th>
        <th>Release Date</th>
        <th>Platform</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($games as $game)
        <tr>
            <td>{{ $game->title }}</td>
            <td>{{ $game->developer }}</td>
            <td>{{ $game->genre }}</td>
            <td>{{ $game->release_date }}</td>
            <td>{{ $game->platform }}</td>
            <td>{{ $game->price }}</td>
            <td>
                <a href="{{ route('games.edit', $game->id) }}">Edit</a>
                <form action="{{ route('games.destroy', $game->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
