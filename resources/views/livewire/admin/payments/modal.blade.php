<div wire:ignore.self class="modal fade" id="payment-modal" tabindex="-1" role="dialog"
    aria-labelledby="payment-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-3">
                    <h5 class="modal-title">Informações sobre o pagamento:</h5>
                </div>
                <div class="mt-3 mb-3 text-left">
                    <h6>Valor do contrato:</h6>
                    <p>{{$contract->valueBRL}}</p>
                </div>
                @if(!$contract->payments->isEmpty())
                    <div class="mt-3 mb-3 text-left">
                        <h6>Pagamentos realizados:</h6>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12 text-left">
                            @foreach($contract->payments as $payment)
                                <p>{{$payment->dateBR}} - {{$payment->valueBRL}}</p>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if($contract->isPaymentDone !== true)
                    <div class="mt-3 mb-3 text-left">
                        <h6>Adicionar pagamento:</h6>
                    </div>
                    @error('*')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <form>
                        @csrf
                        <div class="row">
                            <div class="col-md-12 pr-1 text-left">
                                <p>Valor restante: {{$contract->remainingAmountBRL}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <input type="text" data-mask="00/00/0000" id="date" wire:model.lazy="date" class="form-control" placeholder="Data">
                                </div>
                            </div>
                            <div class="col-md-8 pr-1">
                                <div class="form-group">
                                    <input type="text" id="value" wire:model.defer="value" class="form-control" placeholder="Valor">
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="update ml-auto mr-auto">
                                <button wire:click.prevent="store" type="submit" class="btn btn-primary btn-round">
                                    Adicionar pagamento
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    document.addEventListener('livewire:load', function () {
        $.datetimepicker.setLocale('pt-BR');
        $('#date').datetimepicker({
            'format': 'd/m/Y',
            'timepicker': false
        });
        $('#value').mask('000.000.000.000.000,00', {
            reverse: true
        });
        $('#date').on('change', function (e) {
            @this.set('date', e.target.value);
        });
    });  
</script>
<script type="text/javascript">
    
</script>   
@endpush