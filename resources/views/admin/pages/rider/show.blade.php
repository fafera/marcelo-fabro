@extends('admin.layout.app')
@section('content')
@if($quote->rider != null)
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Rider de palco de {{$quote->infoString}} </h5>
                </div>
                <div class="card-body">
                    <span>Clique <a target="_blank" href="{{asset('storage/rider/'.$quote->rider->file)}}">aqui</a> para baixar o arquivo</span>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <span>Ops! Parece que o rider ainda não foi gerado. Aguarde.</span>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection