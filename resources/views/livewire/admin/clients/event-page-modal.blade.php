<div wire:ignore.self class="modal fade" id="event-page-modal" tabindex="-1" role="dialog"
    aria-labelledby="event-page-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-3">
                    <h5 class="modal-title">Informações sobre a página do evento:</h5>
                    <span class="">Informe ou edite a slug da página que seu cliente acessará</span>
                </div>
                @error('*')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                <form>
                    
                    @csrf
                    <div class="row">
                        <div class="col-md-12 pr-1">
                            <div class="form-group">
                                <input type="text" id="slug" wire:model.lazy="eventPage.slug" class="form-control" placeholder="Título">
                                <small>Atenção: não utilizar acentos, caracteres especiais e espaços em branco. </small>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="update ml-auto mr-auto">
                            <button wire:click.prevent="store" type="submit" class="btn btn-primary btn-round">
                                Salvar página
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
        $(function() {
            $('#slug').on('keypress', function(e) {
                if (e.which == 32){
                    return false;
                }
                var regex = new RegExp("^[a-zA-Z0-9\-]+$");
                var key = String.fromCharCode(!e.charCode ? event.which : e.charCode);
                if (!regex.test(key)) {
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>
    
@endpush