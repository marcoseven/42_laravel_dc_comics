<div class="comic">
    <a href="{{ route('comic', ['id' => $index ]) }}">
        <div class="poster">
            <img src="{{$comic['thumb']}}" alt="{{$comic['title']}} poster">
        </div>


    </a>
    <p>{{$comic['series']}}</p>
</div>
