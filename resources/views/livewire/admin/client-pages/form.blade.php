<div>
    <div class="card-header">
        <h5 class="card-title">Detalhes da Página de Confirmação do Cliente</h5>
    </div>
    <div class="card-body">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <form>
            @csrf
            <div class="row">
                <div class="col-md-12 pr-1">
                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" @if($page->trashed()) {{'disabled'}} @endif wire:model="page.slug" class="form-control" placeholder="Slug">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pr-1">
                    <div class="form-group">
                        <label>Orçamento</label>
                        <input type="text" disabled wire:model="quoteInfoString" class="form-control" placeholder="Orçamento">  
                    </div>
                </div>  
            </div>
            @if(!$page->trashed())
            <div class="row">
                <div class="col-md-12 pr-1">
                    <div class="form-group">
                        <label>Link para enviar para o cliente:</label>
                        <div class="clearfix"></div>
                        <a href="{{route('front.create-page', $page->slug)}}">{!! route('front.create-page', $page->slug) !!}</a>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="update ml-auto mr-auto">
                    @if(!$page->trashed()) 
                        <button wire:click.prevent="delete" class="btn btn-danger btn-round">Deletar página</button>
                    @else 
                        <button disabled class="btn btn-danger btn-round">A Página já foi utilizada e excluída</button>
                    @endif
                </div>
                <div class="update ml-auto mr-auto">
                    <button @if($page->trashed()) {{'disabled'}} @endif wire:click.prevent="update" type="submit" class="btn btn-primary btn-round">Salvar alterações</button>
                </div>
            </div>
        </form>
    </div>
</div>