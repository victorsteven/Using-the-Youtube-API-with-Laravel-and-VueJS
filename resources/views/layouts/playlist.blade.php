@extends('layouts.app')

@section('content')
    
    <div>
        <div>hello</div>
        <ul>
            @foreach ($playlists as $play)
                <li>{{ $play->name }}</li>
                <li>{{ $play->user_id }}</li>
            @endforeach
        </ul>
        
    </div>
@endsection