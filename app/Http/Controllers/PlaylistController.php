<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Playlist;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    //THE PLAYLIST API

    public function index()
    {
        $playlists = Playlist::with('entries')->where('user_id', Auth::user()->id)
                    ->orderBy('updated_at', 'desc')
                    ->get();

        return response()->json($playlists, 200);

        //or simply:
        // return $playlists;

        // for testing purposes: return $playlists;
        // $playlists = Playlist::all();
        // dd($playlists);
        // return view('layouts.playlist', compact('playlists'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'isPrivate' => 'required',
        ]);

        $count = Playlist::where('name', $request->input('name'))->where('user_id', $request->user()->id)->count();

        if ($count) {
            return response()->json(['message' => "Playlist {$request->input('name')} exist."], 403);
        }

        $playlist = Playlist::create([
            'name' => $request->input('name'),
            'user_id' => $request->user()->id,
            'is_private' => $request->input('isPrivate'),
        ]);

        return response()->json($playlist, 201);
    }
}
