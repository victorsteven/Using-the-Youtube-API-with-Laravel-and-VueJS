<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Playlist;

class PlaylistEntryController extends Controller
{
    public function store(Request $request)
    {
        // abort(500, 'some error happened');

        $data = $this->validate($request, [
            'videoId' => 'required',
            //let 'playlistId' exists in the playlists table in the id column
            'playlistId' => 'required|exists:playlists,id',
        ]);

        $playlist = Playlist::find($data['playlistId']);

        $entry = $playlist->entries()->create([
            'user_id' => $request->user()->id,
            'playlist_id' => $data['playlistId'],
            'video_id' => $data['videoId'],
        ]);

        return response()->json($entry, 201);
    }
}
