<html>
    <body>
        <div> 
            @include('partials.bookmarks')
        </div>
        <div>
            @include('partials.form')
        </div>

        @if( $error ) 
        <div>
            <p> Please, use only letters without special characters. </p>
        </div>
        @else 
        <h1> Data for {{ $location }} </h1> 

        <span> Temperature: </span> <span>  {{ $weatherDto->temperature }} </span> <br/>
        <span> Feels like: </span> <span>  {{ $weatherDto->feelsLike }} </span><br/>
        <span> Humidity: </span> <span>  {{ $weatherDto->humidity }} </span><br/>
        <span> Visibility: </span> <span>  {{ $weatherDto->visibility }} </span><br/>
        <span> Description: </span> <span>  {{ $weatherDto->description }} </span><br/>

        @endif
    </body>
</html>