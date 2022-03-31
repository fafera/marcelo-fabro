@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <button id="btn_add" data-href="{{route('admin.projects.create')}}" class="btn btn-primary float-lg-right">Adicionar projeto</button>
                </div>
            </div>
            <div class="card mb-4">
                <div class="table-responsive p-3">
                    <livewire:admin.projects.table/>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $('#btn_add').on('click', function() {
            window.location.href = $(this).data('href');
        });
    </script>
@endpush