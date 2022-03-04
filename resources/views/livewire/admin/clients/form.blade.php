<div>
    <div class="card-header">
        <h5 class="card-title">Detalhes do Cliente</h5>
    </div>
    <div class="card-body">
        @if($this->client->quote !== null)
        <div class="row">
            <div class="col-md-12 mb-2">
                <a href="{{route('admin.quotes.show', $this->client->quote->first()->id)}}" class="btn btn-right btn-primary float-right">Acessar orçamento do cliente</a>
            </div>
        </div>
        @endif
        <form wire:submit.prevent="update">
            @csrf
            <div class="row">
                <div class="col-md-12 pr-1">
                    <div class="form-group">
                        <label>Cliente</label>
                        <input type="text" wire:model="client.name" class="form-control" placeholder="Cliente">
                    </div>
                </div>
                 
            </div>
            <div class="row">
                <div class="col-md-4 pr-1">
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" id="phone" data-mask="(00)00000-0000" wire:model="client.phone" class="form-control" placeholder="Telefone">
                    </div>
                </div> 
                <div class="col-md-4 pr-1">
                    <div class="form-group">
                        <label>CPF</label>
                        <input type="text" wire:model="client.cpf" data-mask="000.000.000-00" class="form-control" placeholder="CPF">
                    </div>
                </div>
                <div class="col-md-4 pr-1">
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" id="email" wire:model="client.email" class="form-control" placeholder="E-mail">
                    </div>
                </div>  
            </div>
            <div class="row">
                <div class="update ml-auto mr-auto">
                    <button wire:click="update" type="submit" class="btn btn-primary btn-round">Salvar alterações</button>
                </div>
            </div>
        </form>
    </div>
</div>