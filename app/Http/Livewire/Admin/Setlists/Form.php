<?php

namespace App\Http\Livewire\Admin\Setlists;

use PDF;
use Exception;
use App\Models\Song;
use App\Models\Quote;
use App\Models\Moment;
use App\Models\Setlist;
use Livewire\Component;
use App\Models\CustomSong;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\CustomMoment;
use Illuminate\Support\Facades\Storage;

class Form extends Component
{
    public $songs;
    public $moments;
    public $moment_select = [];
    public $selectedMoment = [];
    public Quote $quote;
    public $search = [];
    public $results = [];
    public $data = [];
    public $custom_moment;
    public $arraySize;
    public $update = false;
    public $custom_moment_check;
    protected $listeners = ['setCustomSong', 'deleteSetlistRegister'];
    public $rules = [
        'search.*.query' => 'required',
        'custom_moment.*' => 'sometimes',
        'moment_select.*' => 'required',
        'data.*' => 'required'  
    ];
    public $messages = [
        'search.*.query.required' => 'Por favor, preencha todos os momentos.',
        'data.*.required' => 'Por favor, preencha todos os momentos'
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
        } else {
            $this->data[] = [];
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
                'id' => $setlistSong->id,
                'song_id' => $id, 
                'moment_id' => $setlistSong->moment_id, 
                'custom_song' => $custom
            ];
            $this->moment_select[$setlistSong->moment_id] = $setlistSong->moment_id;
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
        $songbook = $this->quote->project->songbook;
        if($songbook != null) {
            $songbook->songs->each(function ($item){
                array_push($this->songs, $item);
            });
        }
        
        $this->songs = collect(Arr::flatten($this->songs));
        $this->songs = $this->songs->unique('id');
    }
    public function store()
    {
        unset($this->results);
        $this->validate();
        $this->saveSetlist();
        if($this->update) {
            session()->flash('message', 'O repertório foi editado com sucesso!');
        } else {
            session()->flash('message', 'O repertório foi cadastrado com sucesso!');
        }
        return $this->redirectWithVerification();
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
        if(!isset($data['song_id'])) {
            $this->checkAndRemoveCustomSong($data);
            return CustomSong::create(['title' => $data['title'], 'performer' => $data['performer'], 'moment_id' => $data['moment_id']]);
        }    
        return CustomSong::find($data['song_id']);
    }
    private function checkAndRemoveCustomSong($data) {
        $setlistSong = Setlist::where('quote_id', $this->quote->id,)->where('moment_id', $data['moment_id'])->first();
        if($setlistSong != null ) {
            $customSong = CustomSong::find($setlistSong->custom_song_id) ;
            $setlistSong->delete();
            $customSong->delete();
            
        }
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
    public function setSong($songId, $dataKey)
    {
        $this->verifyCustomSongBind($dataKey);
        $this->data[$dataKey]['song_id'] = $songId;
        $this->resetResults($dataKey);
        $song = Song::findOrFail($songId);
        $this->search[$dataKey]['query'] = $song->fullString;
    }
    private function verifyCustomSongBind($key) {
        if(isset($this->data[$key]['custom_song'])) {
            unset($this->data[$key]['custom_song']);
        }
        if(isset($this->data[$key]['title'])) {
            unset($this->data[$key]['title']);
        }
        if(isset($this->data[$key]['performer'])) {
            unset($this->data[$key]['performer']);
        }
    }
    private function verifySongIdBind($key) {
        if(isset($this->data[$key]['song_id'])) {
            unset($this->data[$key]['song_id']);
        }
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
    public function updatedMomentSelect($value, $key) {
        $this->data[$key]['moment_id'] = $value;
        
    }
    private function getKeyValue($key)
    {
        $key = explode('.', $key);
        return $key[0];
    }
    public function showCustomSongModal($dataKey)
    {
        $this->resetResults($dataKey);
        $this->dispatchBrowserEvent('showCustomSongModal', ['key' => $dataKey]);
    }
    public function setCustomSong($song)
    {
        $this->dispatchBrowserEvent('closeCustomSongModal');
        $this->verifySongIdBind($song['key']);
        $this->data[$song['key']]['title'] = $song['title']; 
        $this->data[$song['key']]['performer'] = $song['performer'];
        $this->data[$song['key']]['custom_song'] = 1;
        $this->search[$song['key']]['query'] = $song['title'] . " - " . $song['performer'];
    }
    public function addMoment() {
        $this->data[] =  [];
    }
    public function deleteMoment($key) {
        if(isset($this->data[$key]['id'])) {
            return $this->dispatchBrowserEvent('confirmDelete', ['key' => $key, 'id' => $this->data[$key]['id']]);
        }
        unset($this->data[$key]);
    }
    public function deleteSetlistRegister($arrayKey, $id) {
        $register = Setlist::find($id);
        $register->delete();
        unset($this->data[$arrayKey]);
    }
    public function render()
    {
        return view('livewire.admin.setlists.form' );
    }
}
