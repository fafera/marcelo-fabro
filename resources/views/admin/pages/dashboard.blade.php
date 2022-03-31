@extends('admin.layout.app')
@section('content')
    @if(auth()->user())
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body" style="cursor:pointer;" data-href={{route('admin.quotes')}}>
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-warning">
                                <i class="nc-icon nc-paper text-warning"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Orçamentos solicitados</p>
                                <p class="card-title">{{$info->quotes}}
                                <p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body" style="cursor:pointer;" data-href={{route('admin.clients')}}>
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-success">
                                <i class="nc-icon nc-circle-10 text-success"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Clientes captados</p>
                                <p class="card-title">{{$info->clients}}
                                <p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body" style="cursor:pointer;" data-href={{route('admin.songs')}}>
                    <div class="row">
                        <div class="col-5 col-md-4">
                            <div class="icon-big text-center icon-primary">
                                <i class="nc-icon nc-note-03 text-primary"></i>
                            </div>
                        </div>
                        <div class="col-7 col-md-8">
                            <div class="numbers">
                                <p class="card-category">Músicas no repertório</p>
                                <p class="card-title">{{$info->songs}}
                                <p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
@push('scripts')
<script type="text/javascript">
    $('.card-body').on('click', function () {
        window.location.href = $(this).data('href');
    })
</script>
    
@endpush
