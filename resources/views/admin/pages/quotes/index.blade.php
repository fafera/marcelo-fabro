@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="p-3">
                    <livewire:admin.quotes.table/>
                </div>
            </div>
        </div>
    </div>
@endsection
