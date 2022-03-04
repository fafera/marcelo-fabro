@extends('admin.layout.app')
@section('content')
    @if(auth()->user()->role === "admin")
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-body ">
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
                <div class="card-body ">
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
                <div class="card-body ">
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
    @else
        <div class="row">
            <div class="col-lg-12">
                <h5 class="mb-4">Bem-vindo, {{auth()->user()->name}}</h5>
                <div class="mb-4">
                    <h6>Sobre o contrato:</h6>
                    @if($info->contract !== null)
                        <p>Seu contrato já foi gerado e vocẽ pode acessá-lo clicando aqui: <a href="{{route('admin.contracts.self')}}"> ver contrato </a></p>
                    @else
                        <p>Parece que seu contrato ainda não foi gerado. Aguarde.</p>
                    @endif
                </div>
                <div class="mb-4">
                    <h6>Sobre o repertório</h6>
                    @if($info->setlist !== null)
                        <p>Boa! Você já definiu o repertório. Agora é só aguardar o momento tão aguardado.</p>
                        <p>Se quiser conferir as músicas, é só clicar aqui: <a href="{{route('admin.setlists.self')}}"> ver músicas do repertório </a></p>
                    @else
                        <p>Você ainda não definiu seu repertório! <a href="{{route('admin.setlists.self')}}"> Clique aqui </a> para definí-lo agora mesmo.</p>
                    @endif
                </div>
            </div>
        </div>
    @endif

@endsection
