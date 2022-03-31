<div>
    <form wire:submit.prevent="store">
        @csrf
        <input type="hidden" wire:model="quote_id">
        <div class="service-form">
            @error('*')
                <div class="alert alert-danger mb-4 col-lg-12" role="alert">
                    {{$message}}
                </div>
            @enderror
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="form-group service-form-group">
                        <label class="control-label sr-only" for="name"></label>
                        <input wire:model="name" id="name" name="name" type="text" placeholder="Nome completo"
                            class="form-control" required>
                        <div class="form-icon"><i class="fa fa-user"></i></div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <div class="form-group service-form-group">
                        <label class="control-label sr-only" for="cpf"></label>
                        <input data-mask="000.000.000-00" wire:model="cpf" id="cpf" name="cpf" type="text" placeholder="CPF"
                            class="form-control" required>
                        <div class="form-icon"><i class="fa fa-envelope"></i></div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 ">
                    <div class="form-group service-form-group">
                        <label class="control-label sr-only" for="cep"></label>
                        <input wire:model.lazy="cep" data-mask="00000-000"wire:blur="getCepInfo" id="cep"  name="cep" type="text"
                            placeholder="CEP" class="form-control" required>
                        <div class="form-icon"><i class="fa fa-map"></i></div>
                        
                    </div>
                    <div class="mt-1 mb-3" wire:loading wire:target="cep">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                    <div class="form-group service-form-group">
                        <label class="control-label sr-only" for="city"></label>
                        <input wire:model="city" id="city" name="city" type="text"
                            placeholder="Cidade" class="form-control" required>
                        <div class="form-icon"><i class="fa fa-globe"></i></div> 
                        
                    </div>
                    <div class="mt-1 mb-3" wire:loading wire:target="cep">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group service-form-group">
                        <label class="control-label sr-only" for="street"></label>
                        <input wire:model="street" id="street" name="street" type="text"
                            placeholder="Rua" class="form-control" required>
                        <div class="form-icon"><i class="fa fa-road"></i></div>
                        
                    </div>
                    <div class="mt-1 mb-3" wire:loading wire:target="cep">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                    <div class="form-group service-form-group">
                        <label class="control-label sr-only" for="district"></label>
                        <input wire:model="district" id="district" name="district" type="text" 
                            placeholder="Bairro" class="form-control" @isset($district) {{'value="$district"'}} @endisset required>
                        <div class="form-icon"><i class="fa fa-city"></i></div>
                        
                    </div>
                    <div class="mt-1 mb-3" wire:loading wire:target="cep">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                    <div class="form-group service-form-group">
                        <label class="control-label sr-only" for="number"></label>
                        <input wire:model="number" id="number" name="number" type="text" 
                            placeholder="Número" class="form-control" required>
                        <div class="form-icon"><i class="fa fa-arrow-down-1-9"></i></div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                    <div class="form-group service-form-group">
                        <label class="control-label sr-only" for="complement"></label>
                        <input wire:model="complement" id="complement" name="complement" type="text" 
                            placeholder="Complemento" class="form-control">
                        <div class="form-icon"><i class="fa fa-align-right"></i></div>
                    </div>
                </div>
                
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    <button type="submit" class="btn btn-success btn-block mb10">Criar página</button>
                </div>

            </div>
        </div>
    </form>
    {{-- @livewire('front.client-page-confirm-modal')
    @livewire('front.client-page-store-modal') --}}
</div>
@push('scripts')
    {{-- <script type="text/javascript"> 
        window.addEventListener('openConfirmationModal', event => {
            $("#client-page-confirm-modal").modal('show');
        })
        window.addEventListener('closeConfirmationModal', event => {
            $("#client-page-confirm-modal").modal('hide');
        })
        window.addEventListener('openStoreModal', event => {
            $("#client-page-store-modal").modal('show');
        })

        window.addEventListener('closeStoreModal', event => {
            $("#client-page-store-modal").modal('hide');
        })
    </script> --}}
@endpush