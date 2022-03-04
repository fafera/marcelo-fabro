<div>
    <div class="card-header">
        <h5 class="card-title">Detalhes do Orçamento</h5>
    </div>
    <div class="card-body">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @if($this->quote->client !== null)
        <div class="row">
            <div class="col-md-12 mb-2">
                <a href="{{route('admin.clients.show', $this->quote->client->id)}}" class="btn btn-right btn-primary float-right">Dados do cliente</a>
                @if($this->quote->contract !== null)
                <a href="{{route('admin.contracts.show', $this->quote->contract->id)}}" class="btn btn-right btn-success float-right">Visualizar contrato</a>
                @else 
                    <a href="{{route('admin.contracts.generate', $this->quote->id)}}" class="btn btn-right btn-success float-right">Gerar contrato</a>
                @endif
            </div>
            
        </div>
        @elseif($this->quote->clientPage !== null)
            <div class="row">
                <div class="col-md-12 mb-2">
                    <a href="{{route('admin.pages.show', $this->quote->clientPage->id)}}" class="btn btn-right btn-warning float-right">Aguardando confirmação</a>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-12 mb-2">
                    <a href="{{route('admin.pages.create-from-quote', $this->quote->id)}}" class="btn btn-right btn-success float-right">Criar página do cliente</a>
                </div>
            </div>
        @endif
        <form>
            @csrf
            <div class="row">
                <div class="col-md-8 pr-1">
                    <div class="form-group">
                        <label>Cliente</label>
                        <input type="text" wire:model="quote.name" class="form-control" placeholder="Cliente">
                    </div>
                </div>
                <div class="col-md-4 pr-1">
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" id="phone" data-mask="(00)00000-0000" wire:model="quote.phone" class="form-control" placeholder="Telefone">
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-3 pr-1">
                    <div class="form-group">
                        <label>Data</label>
                        <input type="text" id="date" data-mask="00/00/0000" wire:model="quote.date" class="form-control" placeholder="Data">
                    </div>
                </div>
                <div class="col-md-3 pr-1">
                    <div class="form-group">
                        <label>Horário</label>
                        <input type="text" id="time" data-mask="00:00" wire:model="quote.time" class="form-control" placeholder="Horário" >
                    </div>
                </div>
                <div class="col-md-6 pr-1">
                    <div class="form-group">
                        <label>Local</label>
                        <input type="text" class="form-control" wire:model="quote.place" placeholder="Local">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5 pr-1">
                    <div class="form-group">
                        <label>Projeto</label>
                        <select id="project"name="project" wire:model="quote.project_id" class="form-control">
                            <option value=''>Selecione o projeto</option>
                            @foreach($projects as $project)
                                <option value={{ $project->id }}>{{ $project->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-7 pr-1">
                    <div class="form-group">
                        <label>Observações</label>
                        <input type="textarea" wire:model="quote.message" class="form-control" placeholder="Observações">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="update ml-auto mr-auto">
                    <button wire:click.prevent="delete" class="btn btn-danger btn-round">Deletar orçamento</button>
                    <button wire:click.prevent="update" type="submit" class="btn btn-primary btn-round">Salvar alterações</button>
                </div>
            </div>
        </form>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    $.datetimepicker.setLocale('pt-BR');

    $('#date').datetimepicker({
        'format': 'd/m/Y',
        'timepicker': false,
        'scrollInput': false
    });
    $('#time').datetimepicker({
        'format': 'H:i',
        'datepicker': false,
        step: 30
    });    
</script>
<script type="text/javascript">
    document.addEventListener('livewire:load', function () {
        
        $('#date').on('change', function (e) {
            @this.set('quote.date', e.target.value);
        });
        $('#time').on('change', function (e) {
            @this.set('quote.time', e.target.value);
        });
});  
</script>   
@endpush