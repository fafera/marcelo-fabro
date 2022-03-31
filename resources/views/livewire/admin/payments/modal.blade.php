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
                    <p>{{$contract->value}}</p>
                </div>
                @if(!$contract->payments->isEmpty())
                    <div class="mt-3 mb-3 text-left">
                        <h6>Pagamentos realizados:</h6>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12 text-left">
                            @foreach($contract->payments as $payment)
                                <p>{{$payment->created_at}} - {{$payment->value}}</p>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if($contract->isPaymentDone !== true)
                    <div class="mt-3 mb-3 text-left">
                        <h6>Adicionar pagamento:</h6>
                    </div>
                    @error('value')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <form>
                        @csrf
                        <div class="row">
                            <div class="col-md-12 pr-1 text-left">
                                <p>Valor restante: {{$contract->remainingAmount}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pr-1">
                                <div class="form-group">
                                    <input type="text" id="value" wire:model.lazy="value" class="form-control" placeholder="Valor">
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
