<div wire:ignore.self class="modal fade" id="client-page-confirm-modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Minuta do contrato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus quo maxime at aut blanditiis eius,
                ipsam dignissimos cum expedita vero sit nihil voluptate corrupti assumenda iure, magnam quidem dolorum
                eligendi.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-success" wire:click="confirm">Concordar</button>
            </div>
        </div>
    </div>
</div>
