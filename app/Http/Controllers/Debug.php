<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Song;
use App\Models\Client;
use App\Models\Setlist;
use App\Models\SongSongbook;
use Illuminate\Http\Request;
use App\Helpers\FinancialHelper;
use App\Http\Controllers\Controller;
use App\Models\CustomSong;
use Illuminate\Support\Facades\Storage;

class Debug extends Controller
{
    public $client, $quote, $contract;
    public function index() {
        $customSong = CustomSong::findOrFail(17);
        dd($customSong->quote);
    }
    private function setlistImport() {
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
