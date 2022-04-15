<?php

namespace App\Http\Livewire\Admin\Setlists;

use PDF;
use Exception;
use App\Models\Song;
use App\Models\Quote;
use App\Models\Moment;
use App\Models\Setlist;
use Livewire\Component;
use App\Models\Songbook;
use App\Models\CustomSong;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\CustomMoment;
use Illuminate\Support\Facades\Storage;

class Form extends Component
{
    public $songs;
    public $moments;
    public Quote $quote;
    public $search = [];
    public $results = [];
    public $data = [];
    public $custom_moment;
    public $arraySize;
    public $update = false;
    public $custom_moment_check;
    protected $listeners = ['setCustomSong'];
    public $rules = [
        'search.*.query' => 'required',
        'custom_moment.*' => 'sometimes'
    ];
    public $messages = [
        'search.*.query.required' => 'Por favor, preencha todos os momentos.'
    ];
    public function mount(Quote $quote)
    {
        $this->verifySetlistCustomization();
        $this->setPermittedSongs();
        $this->moments = Moment::orderBy('order')->get();
        $this->arraySize = count($this->moments);
        $this->quote = $quote;
        if(!$quote->setlist->isEmpty()) {
            $this->update = true;
            $this->bindData();
            $this->bindCustomMoment();
        }
        
    }
    public function exportPdf() {
        $data = $this->buildPdfData();
        $pdf = PDF::loadView('jobs.pdf.songbook', $data)->setPaper('a4', 'landscape');
        $filename = 'quote_'.$this->quote->id.'_songbook.pdf';
        Storage::disk('public')->put('pdf/'.$filename, $pdf->output());
        $this->dispatchBrowserEvent('showPdf', ['route' => route('pdf.stream', $filename)]);

        //return redirect()->route('pdf.stream', $filename);
    }
    private function buildPdfData() {
        $data = [
            'title' => "Repertório de ".$this->quote->project->title,
            'songs' => $this->songs,
        ];
        return $data;
    }
    private function verifySetlistCustomization() {
        if($this->quote->project->has_songbook !== 1) {
            throw new \Exception('Orçamento inválido');
        }
    }
    private function bindData() {
        foreach($this->quote->setlist as $setlistSong) {
            if(!isset($setlistSong->song)) {
                $id = $setlistSong->customSong->id;
                $custom = true;
                $query = $setlistSong->customSong->fullString;
            } else {
                $id = $setlistSong->song->id;
                $custom = null;
                $query = $setlistSong->song->fullString;
            }
            $this->data[$setlistSong->moment_id] = [
                'song_id' => $id, 
                'moment_id' => $setlistSong->moment_id, 
                'custom_song' => $custom
            ];
            $this->search[$setlistSong->moment_id]['query'] = $query;
        }
    }
    private function bindCustomMoment() {
        if($this->quote->customMoment !== null) {
            $this->custom_moment['title'] = $this->quote->customMoment->title;
            $this->custom_moment['description'] = $this->quote->customMoment->description;
            $this->custom_moment_check = true;
        }
        
    }
    private function setPermittedSongs() {
        $this->songs = [];
        $songbook = Songbook::with('songs')->where('singable', $this->quote->with_singer)->get();
        $songbook->each(function ($item){
            array_push($this->songs, $item->songs->all());
        });
        
        $this->songs = collect(Arr::flatten($this->songs));
        $this->songs = $this->songs->unique('id');
    }
    public function store()
    {
        unset($this->results);
        $this->validate();
        if (count($this->data) === $this->arraySize) {
            $this->saveSetlist();
            if($this->update) {
                session()->flash('message', 'O repertório foi editado com sucesso!');
            } else {
                session()->flash('message', 'O repertório foi cadastrado com sucesso!');
            }
            return $this->redirectWithVerification();
        }
        return $this->addError('search.*.query', 'Ops! Acho que algumas músicas são inválidas.');
    }
    private function redirectWithVerification() {
        if(auth()->user()) {
            return redirect()->route('admin.setlists.show', $this->quote->id);
        } 
        return redirect()->route('information.setlist', $this->quote->eventPage->slug);
    }
    private function saveSetlist() {
        if(isset($this->data)) {
            $this->saveSongs();
            $this->saveCustomMoment();
        }
    }
    private function saveCustomMoment() {
        if(isset($this->custom_moment) && $this->custom_moment_check == true) {
            $storeData = [
                'title' => $this->custom_moment['title'],
                'description' => $this->custom_moment['description'],
                'quote_id' => $this->quote->id,
            ];
            $this->updateOrCreateCustomMoment($storeData);
        } else {
            $this->deleteCustomMoment();
        }
        
    }
    private function updateOrCreateCustomMoment($storeData) {
        $customMoment = CustomMoment::where('quote_id', $storeData['quote_id'])->first();
        if($customMoment !== null) {
            return $customMoment->update($storeData);
        }
        return CustomMoment::create($storeData);
    }
    private function deleteCustomMoment() {
        $customMoment = CustomMoment::where('quote_id', $this->quote->id)->first();
        if($customMoment != null) {
            $customMoment->delete();
        }
    }
    private function saveSongs() {
        foreach($this->data as $register) {
            $storeData = [
                'moment_id' => $register['moment_id'],
                'quote_id' => $this->quote->id,
            ];
            if(isset($register['custom_song'])) {
                $customSong = $this->storeCustomSong($register);
                $storeData['custom_song_id'] = $customSong->id;
                $storeData['song_id'] = null;
            } else {
                $storeData['song_id'] = $register['song_id'];
                $storeData['custom_song_id'] = null;
            }
            $this->updateOrCreateSong($storeData);
        }
    }
    private function storeCustomSong($data) {
        return CustomSong::create(['title' => $data['title'], 'performer' => $data['performer'], 'moment_id' => $data['moment_id']]);
    }
    public function updateOrCreateSong($storeData) {
        $setlist = Setlist::where('quote_id', $storeData['quote_id'])->where('moment_id', $storeData['moment_id'])->first();
        if($setlist !== null) {
            return $setlist->update($storeData);
        }
        return Setlist::create($storeData);
    }
    public function resetSearch($moment)
    {
        $this->search[$moment]['query'] = "";
        $this->results[$moment] = null;
        unset($this->data[$moment]);
    }
    public function setSong($songId, $momentId)
    {
        $this->data[$momentId] = ['song_id' => $songId, 'moment_id' => $momentId];
        $this->resetResults($momentId);
        $song = Song::findOrFail($songId);
        $this->search[$momentId]['query'] = $song->fullString;
    }
    public function resetResults($key)
    {
        $this->results[$key] = null;
    }
    public function updatedSearch($query, $key)
    {
        //$search = Song::where('title', 'like', '%' . $query . '%')->get();
        $search = $this->songs->filter(function($item) use($query){
            if(Str::contains(strtolower($item['title']), $query)) {
                return $item;
            }
        });
        $key = $this->getKeyValue($key);
        $this->results[$key] = $search;
    }
    private function getKeyValue($key)
    {
        $key = explode('.', $key);
        return $key[0];
    }
    public function showCustomSongModal($moment)
    {
        $this->resetResults($moment);
        $this->dispatchBrowserEvent('showCustomSongModal', ['moment' => $moment]);
    }
    public function setCustomSong($song)
    {
        $this->dispatchBrowserEvent('closeCustomSongModal');
        $this->data[$song['moment_id']] = ['title' => $song['title'], 'performer' => $song['performer'],  'moment_id' => $song['moment_id'], 'custom_song' => 1];
        $this->search[$song['moment_id']]['query'] = $song['title'] . " - " . $song['performer'];
    }
    public function render()
    {
        return view('livewire.admin.setlists.form');
    }
}
