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
                @if($update)
                    <div class="update ml-auto mr-auto">
                        <button wire:click.prevent="delete" class="btn btn-danger btn-round">Deletar música</button>
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