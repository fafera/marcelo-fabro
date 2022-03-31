<div>
    <div class="card-header">
        <h5 class="card-title">Criar Página do Cliente</h5>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="store">
            @csrf
            <div class="row">
                <div class="col-md-12 pr-1">
                    <div class="form-group">
                        <label>Orçamento:</label>
                        <select disabled id="quote" name="quote" wire:model="quote" class="form-control">
                            <option value=''>Selecione o orçamento</option>
                            @foreach($quotes as $quote)
                                <option value={{ $quote->id }}>{{ $quote->quoteString }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pr-1">
                    <div class="form-group">
                        <label>Slug (parte da URL que aparecerá no browser):</label>
                        
                        <input type="text" id="slug" wire:model="slug" class="form-control" placeholder="casamento-fulano-de-tal">
                        <small>Atenção: não utilizar acentos, caracteres especiais e espaços em branco. </small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="create ml-auto mr-auto">
                    <button type="submit" class="btn btn-primary btn-round">Criar página</button>
                </div>
            </div>
        </form>
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