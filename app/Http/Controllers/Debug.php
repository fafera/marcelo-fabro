<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\SongSongbook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Debug extends Controller
{
    public function index() {
        $file = Storage::disk('public')->get('setlist_geral.txt');
        
        $songAndArtist = explode(PHP_EOL, $file);
        $songAndArtist = array_filter($songAndArtist);
        foreach($songAndArtist as $data) {
            $str = explode('-', $data);            
            $song = Song::create([
                'title' => trim($str[0]),
                'performer' => trim($str[1])
            ]);
            SongSongbook::create([
                'song_id' => $song->id,
                'songbook_id' => 2
            ]);
        }
        $file = Storage::disk('public')->get('setlist_instrumental.txt');
        
        $songAndArtist = explode(PHP_EOL, $file);
        $songAndArtist = array_filter($songAndArtist);
        foreach($songAndArtist as $data) {
            $str = explode('-', $data);
            $getSong = Song::where('title', $str[0])->first();
            if($getSong !== null) {
                $song = $getSong;
            } else {
                $song = Song::create([
                    'title' => trim($str[0]),
                    'performer' => trim($str[1])
                ]);
            }
            SongSongbook::create([
                'song_id' => $song->id,
                'songbook_id' => 3
            ]);
        }
        
        echo "OK";die;
    }
}
