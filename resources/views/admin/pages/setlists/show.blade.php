@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="table-responsive p-3">
                    <livewire:admin.setlists.form :quote="$quote"/>
                </div>
            </div>
        </div>
    </div>
@endsection