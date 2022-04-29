@extends('admin.layout.app')
@section('content')
<div class="row">
    <div class="col-lg-12">
        @if($quote->client !== null) 
            <div class="row">
                <div class="col-md-12 mb-2">
                    <a href="{{ route('admin.clients.show', $quote->client->id) }}"
                        class="btn btn-right btn-success float-right">Dados do Cliente</a>
                </div>
            </div>
            
        @elseif($quote->clientPage !== null)
            <div class="row">
                <div class="col-md-12 mb-2">
                    <a href="{{ route('admin.pages.show', $quote->clientPage->id) }}"
                        class="btn btn-right btn-warning float-right">Aguardando confirmação</a>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-12 mb-2">
                    <a href="{{ route('admin.pages.create-from-quote', $quote->id) }}"
                        class="btn btn-right btn-success float-right">Criar página do cliente</a>
                </div>
            </div>
        @endif
    </div>
</div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="table-responsive p-3">
                    <livewire:admin.quotes.form :quote="$quote"/>
                </div>
            </div>
        </div>
    </div>
@endsection