<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quote;
use App\Models\Contract;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContractsController extends Controller
{
    public function generate($id){ 
        return view('admin.pages.contracts.generator', ['quote' => Quote::findOrFail($id)]);
    }
    public function show($id) {
        return view('admin.pages.contracts.show', ['contract' => Contract::findOrFail($id)]);
    }
    public function upload(Request $request) {
        $file = $request->file('new_contract');
        $contract = Contract::findOrFail($request->get('contract_id'));
        if($file->isValid() && $file->extension() == 'pdf') {
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/pdf', $fileName);
            $contract->file = $fileName;
            $contract->save();
            session()->flash('message', 'Contrato alterado com sucesso!');
            return redirect()->route('admin.contracts.show', $contract->id);
        }
        session()->flash('message', 'Ops! Algo deu errado. Tente novamente.');
        return redirect()->route('admin.contracts.show', $contract->id);

    }
    public function index() {
        return view('admin.pages.contracts.index');
    }
}
