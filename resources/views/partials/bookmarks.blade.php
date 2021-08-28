        <p><a href="{{ url('weather') }}">Home</a></p>
        <p><a href="{{ url('clearBookmarks') }}">Clear bookmarks</a></p>
        @foreach ($bookmarks as $bookmark)
        <span><a href="{{ url('weather/') }}/{{ $bookmark }}"> {{ $bookmark }}</a></span> || 
        @endforeach
        