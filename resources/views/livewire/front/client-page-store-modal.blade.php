<div wire:ignore.self class="modal fade" id="client-page-store-modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-3">
                    <h5 class="modal-title">Sucesso!</h5>
                    <span class="">Tudo certo com o seu cadastro. Agora, você só precisa definir uma senha para acesso ao sistema.</span>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">Senha</label>

                    <div class="col-md-6">
                        <input id="password" wire:model="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirme sua senha</label>

                    <div class="col-md-6">
                        <input id="password-confirm" wire:model="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
                <button type="button" wire:click="create" class="btn btn-success">Definir senha agora</button>
                
            </div>
        </div>
    </div>
</div>
