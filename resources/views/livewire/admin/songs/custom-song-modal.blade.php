<div wire:ignore.self class="modal fade" id="custom-song-modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-3">
                    <h5 class="modal-title">Cadastar nova música:</h5>
                    <span class="">Informe o nome da música e o artista no formulário abaixo para prosseguir.</span>
                </div>
                @error('*')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                <form>
                    <input type="hidden" id="moment_id" wire:change="setMomentId" wire:model.lazy="moment_id">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 pr-1">
                            <div class="form-group">
                                <input type="text" wire:model.lazy="title" class="form-control" placeholder="Título">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 pr-1">
                            <div class="form-group">
                                <input type="text" wire:model.lazy="performer" class="form-control" placeholder="Artista">  
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="update ml-auto mr-auto">
                            <button wire:click.prevent="store" type="submit" class="btn btn-primary btn-round">
                                Adicionar música
                            </button>
                        </div>
                    </div>
                </form>

                
            </div>
        </div>
    </div>
</div>
