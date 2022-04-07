<div>
    <div class="card-header">
        <h5 class="card-title">Detalhes do Momento</h5>
    </div>
    <div class="card-body">
        <form>
            @csrf
            <div class="row">
                <div class="col-md-12 pr-1">
                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" wire:model.lazy="moment.title" class="form-control" placeholder="Título">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pr-1">
                    <div class="form-group">
                        <label>Ordem</label>
                        <input type="number" wire:model.lazy="moment.order" class="form-control" placeholder="Ordem">  
                    </div>
                </div>  
            </div>
           
            <div class="row">
                @if($update)
                    <div class="update ml-auto mr-auto">
                        <button onclick="confirm('Você tem certeza?') || event.stopImmediatePropagation();"  wire:click.prevent="delete" class="btn btn-danger btn-round">Deletar momento</button>
                    </div>
                @endif
                <div class="update ml-auto mr-auto">
                    <button wire:click.prevent="store" type="submit" class="btn btn-primary btn-round">
                        @if($update) {{ 'Salvar Alterações' }} @else {{ 'Adicionar momento' }} @endif
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>