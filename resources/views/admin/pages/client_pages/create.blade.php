@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <livewire:admin.clients.create-page-form :quote="$quote"/>
                </div>
            </div>
        </div>
    </div>
@endsection