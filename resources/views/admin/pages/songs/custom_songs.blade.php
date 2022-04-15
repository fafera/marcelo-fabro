@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <button id="btn-songs" data-href="{{route('admin.songs')}}" class="btn btn-warning float-lg-right">Músicas do repertório</button>
                </div>
            </div>
            <div class="card mb-4">
                <div class="table-responsive p-3">
                    <livewire:admin.songs.custom-songs-table/>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $('#btn-songs').on('click', function() {
            window.location.href = $(this).data('href');
        });
    </script>
@endpush