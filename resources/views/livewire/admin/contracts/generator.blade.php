<div>
    <div class="card-header">
        <h5 class="card-title">Gerar Contrato</h5>
        <small> Atenção: antes de gerar o contrato, confira se todos os dados do cliente e orçamento estão completos.</small>
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
                <div class="col-md-12 pr-1">
                    <div class="form-group">
                        <label>Orçamento</label>
                        <input type="text" disabled wire:model="quoteInfoString" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 pr-1">
                    <div class="form-group">
                        <label>Valor final do contrato</label>
                        <input type="text" id="value" data-mask="000.000.000.000.000,00', {reverse: true}"
                             wire:model.lazy="value" required class="form-control">
                    </div>
                </div>
                <div class="col-md-8 pr-1">
                    <div class="form-group">
                        <label>Valor por extenso</label>
                        <input type="text" required id="value_in_full" wire:model.lazy="contract.value_in_full"
                            class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pr-1">
                    <div class="form-group" wire:ignore>
                        <label>Momentos da cláusula primeira</label>
                        <textarea id="custom_text"  wire:model.debounce.9999999ms="contract.custom_text" class="form-control">
                        </textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="update ml-auto mr-auto">
                    <button wire:click.prevent="generate" type="submit" class="btn btn-success btn-round">Gerar
                        contrato</button>
                </div>
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        $('#value').mask('000.000.000.000.000,00', {
            reverse: true
        });
        ClassicEditor
            .create(document.querySelector('#custom_text'), {
                toolbar: ['bold', 'italic', 'link', '|', 'bulletedList', 'numberedList'],
            })  
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    @this.set('contract.custom_text', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            })
            .dataProcessor.writer.lineBreakChars = '<br>';
        
    </script>
@endpush
