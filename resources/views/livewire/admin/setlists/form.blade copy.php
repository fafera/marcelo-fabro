<div>
    <div class="card-header">
        <h5 class="card-title">Definir repertório</h5>
        <small>Se quiser ter acesso ao repertório completo, <a href="#" wire:click="exportPdf">clique aqui</a> para baixá-lo.</small>
        @error('search.*')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="card-body">
        <form id="setlist-form">
            @csrf
            @foreach ($moments as $moment)
                <div class="row">
                    <div class="col-md-12 pr-1">
                        <div class="form-group">
                            <label>{{ $moment->title }}</label>
                            <input type="text" id="search_{{$moment->id}}" wire:model="search.{{ $moment->id }}.query"
                                wire:keydown.escape="resetSearch({{ $moment->id }})" data-id="{{$moment->id}}" class="form-control search-input"
                                placeholder="Digite o nome da música...">
                            @if(isset($data[$moment->id]) && isset($data[$moment->id]['custom_song']) && auth()->user())
                                <span class="badge badge-warning">Música sugerida pelo cliente</span></h6>
                            @endif
                        </div>
                    </div>
                </div>
                @if(isset($results[$moment->id]) && $results[$moment->id] != null)
                    <div class="row">
                        <div class="col-md-12 pr-1">
                            <ul class="list-group">
                                @if ($results[$moment->id]->first() !== null)
                                    @foreach ($results[$moment->id] as $result)
                                        <li class="list-group-item"><a href="#"
                                                wire:click="setSong({{ $result['id'] }}, {{ $moment->id }})">{{ $result['title'] }}
                                                - {{ $result['performer'] }}</a></li>
                                    @endforeach
                                @else
                                    <li class="list-group-item"><a wire:click="showCustomSongModal({{$moment->id}})" href="#">Não encontrou?
                                            Clique aqui e insira a música que você deseja.</a></li>
                                @endif

                            </ul>
                        </div>
                    </div>
                @endif
            @endforeach
            <div class="row">
                <div class="col-md-12 pr-1">
                    <div class="form-check">
                        <div class="form-check form-check-inline mr-5" >
                            <input class="form-check-input" @if(isset($custom_moment)) {{'checked'}} @endif type="checkbox" id="custom_moment_checkbox">
                            <label class="form-check-label" for="custom_moment_checkbox">Quero informar um momento que não está na lista</label>
                        </div>
                    </div>
                </div>
            </div>
            <div id="custom_moment_container" wire:ignore.self class="row" style="@if(!isset($custom_moment)) {{'display:none'}} @endif">
                <div class="col-md-12 pr-1">
                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" class="form-control" wire:model.lazy="custom_moment.title"
                            placeholder="Digite o título deste momento...">
                    </div>
                </div>
                <div class="col-md-12 pr-1">
                    <div class="form-group">
                        <label>Descrição</label>
                        <textarea class="form-control" wire:model.lazy="custom_moment.description" placeholder="Descreva como seria este momento e qual seria a música a ser executada."></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="update ml-auto mr-auto">
                    <button wire:click.prevent="store" type="submit" class="btn btn-success btn-round">Salvar repertório</button>
                </div>
            </div>
        </form>
        <livewire:admin.songs.custom-song-modal />
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        window.addEventListener('showPdf', event => {
            window.open(event.detail.route, '_blank');
        });
        window.addEventListener('showCustomSongModal', event => {
            $("#custom-song-modal").modal('show');
            Livewire.emit('setMomentId', event.detail.moment);
        });
        window.addEventListener('closeCustomSongModal', event => {
            $("#custom-song-modal").find('form').trigger('reset');
            $("#custom-song-modal").modal('hide');
        });
        // window.addEventListener('checkCustomMomentCheckbox', event => {
        //     $('.wrapper').html('arara');
        // })
        $('#custom_moment_checkbox').on('change', function() {
            if(this.checked) {
                @this.custom_moment_check = true;
                return $('#custom_moment_container').show();
            }
            @this.custom_moment_check = false;
            return $('#custom_moment_container').hide();
        });
        // $('.search-input').on("blur", function(event) {
        //     var moment_id = $(this).data('id');
        //     console.log();
        //     @this.resetSearch(moment_id);
        // });
</script>
 
@endpush
