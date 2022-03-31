<div>
    <div class="card-header">
        <h5 class="card-title">{{$title}}</h5>
    </div>
    <div class="card-body">
        <form>
            @csrf
            <div class="row">
                <div class="col-md-12 pr-1">
                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" wire:model="project.title" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pr-1">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input id="has_songbook" wire:model="project.has_songbook" class="form-check-input" type="checkbox">
                            Possui repertório customizado
                            {{-- <span class="form-check-sign">
                                <span class="check"></span>
                            </span> --}}
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                @if($update)
                    <div class="update ml-auto mr-auto">
                        <button onclick="confirm('Você tem certeza?') || event.stopImmediatePropagation();"  wire:click.prevent="delete" class="btn btn-danger btn-round">Deletar projeto</button>
                    </div>
                @endif
                <div class="update ml-auto mr-auto">
                    <button wire:click.prevent="store" type="submit" class="btn btn-success btn-round">Salvar projeto</button>
                </div>
            </div>
        </form>
    </div>
</div>