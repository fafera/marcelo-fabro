<div>
    <div class="card-header">
        <h5 class="card-title">Endereço</h5>
    </div>
    <div class="card-body">
        @error('*')
            <div class="alert alert-danger mb-4 col-lg-12" role="alert">
                {{$message}}
            </div>
        @enderror
        <form>
            @csrf
            <div class="row">
                <div class="col-md-3 pr-1">
                    <div class="form-group">
                        <label>CEP</label>
                        <input type="text" id="cep" wire:model.lazy="address.cep" data-mask="00000-000"wire:blur="getCepInfo" class="form-control" placeholder="CEP">
                    </div>
                </div> 
                <div class="col-md-9 pr-1">
                    <div class="form-group">
                        <label>Rua</label>
                        <input type="text" wire:model="address.street" class="form-control" placeholder="Rua">
                    </div>
                </div>
            </div>
            <div class="mt-1 mb-3" wire:loading wire:target="address.cep">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 pr-1">
                    <div class="form-group">
                        <label>Cidade</label>
                        <input type="text" wire:model="address.city" class="form-control" placeholder="Cidade">
                    </div>
                </div>
                <div class="col-md-6 pr-1">
                    <div class="form-group">
                        <label>Bairro</label>
                        <input type="text" id="district" wire:model="address.district" class="form-control" placeholder="Bairro">
                    </div>
                </div>  
                
            </div>
            <div class="row">
                <div class="col-md-6 pr-1">
                    <div class="form-group">
                        <label>Número</label>
                        <input type="text" id="number" wire:model="address.number" class="form-control" placeholder="Número">
                    </div>
                </div> 
                <div class="col-md-6 pr-1">
                    <div class="form-group">
                        <label>Complemento</label>
                        <input type="text" id="complement" wire:model="address.complement" class="form-control" placeholder="Complemento">
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="update ml-auto mr-auto">
                    <button wire:click.prevent="store" type="submit" class="btn btn-primary btn-round">Salvar alterações</button>
                </div>
            </div>
        </form>
    </div>
</div>
