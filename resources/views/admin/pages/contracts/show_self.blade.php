@extends('front.layout.event')
@section('content')
@isset($contract)

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Contrato de {{$contract->quote->infoString}} </h5>
                </div>
                <div class="card-body">
                    <span>Clique <a target="_blank" href="{{asset('storage/pdf/'.$contract->file)}}">aqui</a> para baixar o contrato</span>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <span>Ops! Parece que seu contrato ainda não foi gerado. Aguarde.</span>
                </div>
            </div>
        </div>
    </div>
@endisset
@endsection