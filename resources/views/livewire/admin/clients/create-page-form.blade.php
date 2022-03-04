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
                        <label>Orçamento</label>
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
                        <label>Slug</label>
                        <input type="text" id="slug" wire:model="slug" class="form-control" placeholder="/fulano-de-tal">
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
