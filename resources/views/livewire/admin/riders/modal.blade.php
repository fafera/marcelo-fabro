<div wire:ignore.self class="modal fade" id="rider-modal" tabindex="-1" role="dialog"
    aria-labelledby="rider-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-3">
                    <h5 class="modal-title mb-2">Rider de palco:</h5>
                    @if($update)
                    <span><a wire:click="download" href="#">Clique aqui</a> para baixar o arquivo atual</span>
                    @else
                    <span>Faça o upload do arquivo da imagem do rider</span>
                    @endif
                    
                </div>
                @error('*')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-12 pr-1">
                            <div class="form-control mt-3">
                                <input wire:model="file" class="form-control" name="file" type="file" id="file">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="update ml-auto mr-auto">
                            <button wire:click.prevent="store" type="submit" class="btn btn-primary btn-round">
                                Salvar rider
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        
    </script>
    
@endpush