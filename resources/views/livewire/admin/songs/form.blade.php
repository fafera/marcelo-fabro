<div>
    <div class="card-header">
        <h5 class="card-title">Adicionar música ao repertório</h5>
    </div>
    <div class="card-body">
        <form>
            @csrf
            <div class="row">
                <div class="col-md-12 pr-1">
                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" wire:model="song.title" class="form-control" placeholder="Título">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pr-1">
                    <div class="form-group">
                        <label>Artista</label>
                        <input type="text" wire:model="song.performer" class="form-control" placeholder="Artista">  
                    </div>
                </div>  
            </div>
            <div class="row">
                <div class="col-md-12 pr-1">
                    <div class="form-check">
                        <label>Repertório pertencente</label>
                        <div class="clearfix"></div>
                        @foreach($songbooks as $songbook)
                            <div class="form-check form-check-inline mr-5" wire:key="{{$songbook->id}}" >
                                <input wire:model="songbooks_relation.{{$songbook->id}}" class="form-check-input" type="checkbox" id="{{$songbook->id}}">
                                <label class="form-check-label" for="{{$songbook->id}}">{{$songbook->title}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>  
            </div>
            <div class="row">
                @if($update)
                    <div class="update ml-auto mr-auto">
                        <button onclick="confirm('Você tem certeza?') || event.stopImmediatePropagation();"  wire:click.prevent="delete" class="btn btn-danger btn-round">Deletar música</button>
                    </div>
                @endif
                <div class="update ml-auto mr-auto">
                    <button wire:click.prevent="store" type="submit" class="btn btn-primary btn-round">
                        @if($update) {{ 'Salvar Alterações' }} @else {{ 'Adicionar música' }} @endif
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>