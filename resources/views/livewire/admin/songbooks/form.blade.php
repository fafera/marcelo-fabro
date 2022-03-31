<div>
    <div class="card-header">
        <h5 class="card-title">{{$title}}</h5>
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
                        <label>Título</label>
                        <input type="text" wire:model="songbook.title" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pr-1">
                    <div class="form-check">
                            <div class="form-check form-check-inline mr-5">
                                <label class="form-check-label" for="singable">Possui vocal</label>
                                <input id="singable" wire:model="songbook.singable" class="form-check-input" type="checkbox">
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                @if($update)
                    <div class="update ml-auto mr-auto">
                        <button onclick="confirm('Você tem certeza?') || event.stopImmediatePropagation();"  wire:click.prevent="delete" class="btn btn-danger btn-round">Deletar repertório</button>
                    </div>
                @endif
                <div class="update ml-auto mr-auto">
                    <button wire:click.prevent="store" type="submit" class="btn btn-success btn-round">Salvar repertório</button>
                </div>
            </div>
        </form>
    </div>
</div>
@if($update)
<hr>
<div class="row">
    <div class="col-lg-12">
        <div class="p-3">
            <livewire:admin.songbooks.song-list :songbook="$songbook"/>
        </div>
    </div>
</div>
@endif