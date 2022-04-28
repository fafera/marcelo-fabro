<div class="row">
    <div class="col-md-12 pr-1">
        <div class="form-group">
            <label>Selecione o momento que deseja adicionar:</label>
            <select id="moments" class="form-control" wire:model="moment_select">
                <option>Selecione o momento:</option>
                @foreach ($moments as $moment)
                    <option wire:key="{{$moment->id}}" value="{{$moment->id}}">{{$moment->title}}</option>
                @endforeach
            </select>
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