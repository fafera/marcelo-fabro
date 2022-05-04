<div>
    <div class="card-header">
        <h5 class="card-title">Definir repertório</h5>
        <small>Se quiser ter acesso ao repertório completo, <a href="#" wire:click="exportPdf">clique aqui</a> para baixá-lo.</small>
        @error('*')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="card-body">
        <form wire:submit.prevent="store" id="setlist-form">
            @csrf
            @foreach($data as $key => $input)
                <div class="row">
                    <div class="col-md-12 pr-1">
                        <div class="form-group" id="moment-input-container" wire:key="{{time().$key}}">
                            <label>Selecione o momento que deseja adicionar:</label>
                            <select wire:model="moment_select.{{$key}}"  id="moments" class="form-control">
                                <option>Selecione o momento:</option>
                                @foreach ($moments as $moment)
                                    <option value="{{ $moment->id }}">{{ $moment->title }}</option>
                                @endforeach
                            </select>
                            <input type="text" id="search-input-{{$key}}"
                                class="form-control search-input mt-2" placeholder="Digite o nome da música..."
                                wire:model="search.{{ $key }}.query"
                                
                                wire:keydown.escape="resetSearch({{ $key }})" 
                                >
                            <button class="btn btn-sm btn-danger float-right" wire:click.prevent="deleteMoment({{$key}})"><i class="nc-icon nc-simple-remove"></i></button>
                        </div>
                    </div>
                </div>
                @if (isset($results[$key]) && $results[$key] != null)
                    <div class="row">
                        <div class="col-md-12 pr-1">
                            <ul class="list-group">
                                @if ($results[$key]->first() !== null)
                                    @foreach ($results[$key] as $result)
                                        <li class="list-group-item"><a href="#"
                                                wire:click="setSong({{ $result['id'] }}, {{ $key }})">{{ $result['title'] }}
                                                - {{ $result['performer'] }}</a></li>
                                    @endforeach
                                @else
                                    <li class="list-group-item"><a wire:click="showCustomSongModal({{ $key }})" href="#">Não
                                            encontrou?
                                            Clique aqui e insira a música que você deseja.</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                @endif
            @endforeach     
            <div class="row">
                <div class="col-lg-12">
                    <button type="button" wire:click="addMoment" class="btn btn-primary">Adicionar outro momento</button>
                </div>
            </div>
            <div class="row" id="custom_moment_div">
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
                    <button  type="submit" class="btn btn-success btn-round">Salvar repertório</button>
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
            console.log(event.detail.key);
            Livewire.emit('setDataKey', event.detail.key);
        });
        window.addEventListener('closeCustomSongModal', event => {
            $("#custom-song-modal").find('form').trigger('reset');
            $("#custom-song-modal").modal('hide');
        });
        window.addEventListener('appendInput', event => {
            $('#moment-input-container').append(event.detail.view);
        });
        window.addEventListener('setFocusToSearch', event => {
            console.log(event.detail.input);
            $('#'+event.detail.input).focus();
        });
        window.addEventListener('confirmDelete', event => {
            if(confirm("Você realmente deseja tirar esta música do repertório?")) {
                Livewire.emit('deleteSetlistRegister', event.detail.key, event.detail.id);
            } else {
                alert('Tá ok, não deleta então!');
            }
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
