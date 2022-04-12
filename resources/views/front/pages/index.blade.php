@extends('front.layout.event')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h5 class="mb-4">Bem-vindo(a), {{$information->client->name}}</h5>
        <div class="mb-4">
            <h6>Informações sobre o evento</h6>
            <p>Seu evento acontecerá no dia {{$information->quote->date}} às {{$information->quote->time}} no {{$information->quote->place}} com o projeto {{$information->quote->project->title}}.
        </div>
        <div class="mb-4">
            <h6>Sobre o contrato:</h6>
            @if($information->contract !== null)
                <p>Seu contrato já foi gerado e vocẽ pode acessá-lo clicando aqui: <a href="{{route('information.contract',  $information->slug)}}"> ver contrato </a></p>
            @else
                <p>Parece que seu contrato ainda não foi gerado. Aguarde.</p>
            @endif
        </div>
        @if($information->quote->project->has_songbook == 1) 
            <div class="mb-4" id="setlist-content">
                <h6>Sobre o repertório</h6>
                @if(!$information->quote->setlist->isEmpty())
                    <p>Boa! Você já definiu o repertório. Agora é só aguardar o momento tão aguardado.</p>
                    <p>Se quiser conferir as músicas, é só clicar aqui: <a href="{{route('information.setlist',  $information->slug)}}"> ver músicas do repertório </a></p>
                @else
                    <p>Você ainda não definiu seu repertório! <a href="{{route('information.setlist',  $information->slug)}}"> Clique aqui </a> para definí-lo agora mesmo.</p>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection