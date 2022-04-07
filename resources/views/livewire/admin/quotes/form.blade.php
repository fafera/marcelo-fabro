<div>
    <div class="card-header">
        <h5 class="card-title">Detalhes do Orçamento</h5>
    </div>
    <div class="card-body">
        @error('*')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @enderror
        <form>
            @csrf
            <div class="row">
                <div class="col-md-8 pr-1">
                    <div class="form-group">
                        <label>Cliente (nome informado na hora de solicitar orçamento)</label>
                        <input type="text" disabled wire:model.lazy="quote.name" class="form-control" placeholder="Cliente">
                    </div>
                </div>
                <div class="col-md-4 pr-1">
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" id="phone" data-mask="(00)00000-0000" wire:model.lazy="quote.phone"
                            class="form-control" placeholder="Telefone">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-2 pr-1">
                    <div class="form-group">
                        <label>Data</label>
                        <input type="text" id="date" data-mask="00/00/0000" wire:model.lazy="quote.date"
                            class="form-control" placeholder="Data">
                    </div>
                </div>
                <div class="col-md-2 pr-1">
                    <div class="form-group">
                        <label>Horário</label>
                        <input type="text" id="time" data-mask="00:00" wire:model.lazy="quote.time" class="form-control"
                            placeholder="Horário">
                    </div>
                </div>
                <div class="col-md-4 pr-1">
                    <div class="form-group">
                        <label>Local</label>
                        <input type="text" class="form-control" wire:model.lazy="quote.place" placeholder="Local">
                    </div>
                </div>
                <div class="col-md-4 pr-1">
                    <div class="form-group">
                        <label>Cidade</label>
                        <input type="text" class="form-control" wire:model.lazy="quote.city" placeholder="Cidade">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 pr-1">
                    <div class="form-group">
                        <label>Projeto</label>
                        <select id="project" name="project" wire:model.lazy="quote.project_id" class="form-control">
                            <option value=''>Selecione o projeto</option>
                            @foreach ($projects as $project)
                                <option value={{ $project->id }}>{{ $project->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2 pr-1">
                    <div class="form-group">
                        <div class="form-check form-check-inline mt-3">
                            <input class="form-check-input" type="checkbox" wire:model.defer="quote.with_singer"
                                id="with_singer">
                            <label class="form-check-label" for="with_singer">
                                Formação com vocalista
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 pr-1">
                    <div class="form-group">
                        <label>Observações</label>
                        <input type="textarea" wire:model.lazy="quote.message" class="form-control"
                            placeholder="Observações">
                    </div>
                </div>
            </div>
            <div class="row">
                @if($update)
                    <div class="update ml-auto mr-auto">
                        <button onclick="confirm('Você tem certeza?') || event.stopImmediatePropagation();"  wire:click.prevent="delete" class="btn btn-danger btn-round">Deletar orçamento</button>
                    </div>
                @endif
                <div class="update ml-auto mr-auto"> 
                    <button wire:click.prevent="update" type="submit" class="btn btn-primary btn-round">Salvar
                        alterações</button>
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
        document.addEventListener('livewire:load', function() {
            $('#date').on('change', function(e) {
                @this.set('quote.date', e.target.value);
            });
            $('#time').on('change', function(e) {
                @this.set('quote.time', e.target.value);
            });
        });
    </script>
@endpush
