<?php

namespace App\Http\Livewire\Admin\Contracts;

use PDF;
use Carbon\Carbon;
use App\Models\Quote;
use App\Models\Client;
use Livewire\Component;
use App\Models\Contract;
use App\Helpers\DateHelper;
use App\Helpers\FinancialHelper;
use Illuminate\Support\Facades\Storage;

class Generator extends Component
{
    public $quoteInfoString, $value;
    public Contract $contract;
    public Client $client;
    public Quote $quote;

    public $rules = [
        'value' => 'required',
        'contract.value_in_full' => 'required',
        'contract.custom_text' => 'sometimes'
    ];
    public function getPDF()
    {
        return $this->pdf;
    }
    public function generate()
    {
        $this->validate();
        $this->contract->value = $this->value;
        $this->contract->client_id = $this->client->id;
        $this->contract->quote_id = $this->quote->id;
        $this->contract->file = $this->formatFilename();
        $this->contract->save();
        $pdf = $this->generatePDF();
        Storage::disk('local')->put('public/pdf/'.$this->contract->file, $pdf->output());
        session()->flash('message', 'O contrato foi gerado com sucesso!');
        /* return response()->streamDownload(function () {
            print($this->generatePDF()->stream());
        }, $this->contract->file); */
        return redirect()->route('admin.contracts.show', $this->contract->id);
    }
    private function formatFilename() {
        $fileName = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/", "/(ç)/", "/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"),$this->client->name);
        $fileName = strtolower(str_replace(' ', '-', $fileName));
        return 'contrato-'.strtolower($fileName).'.pdf';
    }

    public function mount(Quote $quote)
    {
        $this->contract = Contract::make();
        $this->quote = $quote;
        $this->client = $quote->client->first();
        $this->quoteInfoString = $quote->info_string;
    }
    private function generatePDF()
    {
        $data = [
            'title' => 'Contrato de apresentação artística - '.$this->client->name,
            'name' => $this->client->name,
            'cpf' => $this->client->cpf,
            'address' => $this->client->address->full_address,
            'date' => $this->quote->date,
            'time' => $this->quote->time,
            'place' => $this->quote->place,
            'city' => 'Farroupilha',
            'value' => $this->value,
            'value_in_full' => $this->contract->value_in_full,
            'custom_text' => $this->getCustomText(),
            'limit_date' => $this->getPaymentLimitDate(),
            'value_entrance' => FinancialHelper::formatToBRL($this->contract->value - ($this->contract->value * (80 / 100))),
            'value_final' => FinancialHelper::formatToBRL($this->contract->value - ($this->contract->value * (20 / 100)))
        ];
        return PDF::loadView('jobs.pdf.contract-view', $data);
    }
    private function getPaymentLimitDate()
    {
        $date = Carbon::parse(DateHelper::convertToDateFormat($this->quote->date))->subMonth()->format('Y-m-d');
        return DateHelper::covertToBRDateFormat($date);
    }
    private function getCustomText() {
        $text = str_replace('<p>', '', $this->contract->custom_text);
        return str_replace('</p>', '', $text);
    }
    public function render()
    {
        return view('livewire.admin.contracts.generator');
    }
}
