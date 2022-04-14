<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Song;
use App\Models\Client;
use App\Models\SongSongbook;
use Illuminate\Http\Request;
use App\Helpers\FinancialHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class Debug extends Controller
{
    public $client, $quote, $contract;
    public function index() {
        $this->client = Client::findOrfail(2);
        $this->contract = $this->client->contract;
        $this->quote = $this->client->quote;
        $date = Carbon::now()->locale('pt_BR');
        $date = "Farroupilha, ". $date->day. " de ". ucfirst($date->monthName). " de ".$date->year.".";
       
        $data = [
            'title' => 'Contrato de apresentação artística - ' . $this->client->name,
            'name' => $this->client->name,
            'cpf' => $this->client->cpf,
            'address' => $this->client->address->full_address,
            'date' => $this->quote->date,
            'time' => $this->quote->time,
            'place' => $this->quote->place,
            'city' => $this->quote->city,
            'value' => "100",
            'value_in_full' => $this->contract->value_in_full,
            'custom_text' => 'arara',
            'limit_date' => date('Y-m-d'),
            'signature_date' => $date,
            'value_entrance' => FinancialHelper::formatToBRL($this->contract->value - ($this->contract->value * (80 / 100))),
            'value_final' => FinancialHelper::formatToBRL($this->contract->value - ($this->contract->value * (20 / 100)))
        ];
        return view('jobs.pdf.contract-view', $data);
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
