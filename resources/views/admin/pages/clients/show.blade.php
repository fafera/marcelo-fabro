@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            @isset($client->quote)
                <h5>{{$client->quote->infoString}}</h5>
            @else
                <h5> {{$client->name}} </h5>
            @endisset
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
        <livewire:admin.clients.actions :client="$client"/> 
        </div>   
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="p-3">
                    <livewire:admin.clients.form :client="$client"/>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="p-3">
                    <livewire:admin.clients.address-form :client="$client"/>
                </div>
            </div>
        </div>
    </div>
@endsection