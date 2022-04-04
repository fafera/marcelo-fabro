<?php

namespace App\Http\Livewire\Admin\Songbooks;

use PDF;
use Livewire\Component;
use App\Models\Songbook;
use Illuminate\Support\Facades\Storage;

class Export extends Component
{
    public Songbook $songbook;
    public $data, $pdf;
    public function mount($id) {
        $this->songbook = Songbook::findOrFail($id);
        $this->export();
    }
    private function export() {
        $this->buildData();
        $pdf = PDF::loadView('jobs.pdf.songbook', $this->data)->setPaper('a4', 'landscape');
        Storage::disk('local')->put('public/pdf/'.'songbook.pdf', $pdf->output());
        return redirect()->route('pdf.stream', 'songbook.pdf');        
        
    }
    public function render() {
        return "<div></div>";
    }
    private function buildData() {
        $this->data = [
            'title' => $this->songbook->title,
            'songs' => $this->songbook->songs,
            
        ];
    }
}
