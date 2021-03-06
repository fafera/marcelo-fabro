<form wire:submit.prevent="request" action="{{route('front.quote.request')}}">
    @csrf
    <div class="service-form">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb10 ">
                <h3>Solicitar Orçamento</h3>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <div class="form-group service-form-group">
                    <label class="control-label sr-only" for="name"></label>
                    <input wire:model.lazy="quote.name" id="name" name="name" type="text" placeholder="Seu nome" class="form-control" required>
                    <div class="form-icon"><i class="fa fa-user"></i></div>
                </div>
            </div>
            
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <div class="form-group service-form-group">
                    <label class="control-label sr-only" for="email"></label>
                    <input wire:model.lazy="quote.email" id="email" name="email" type="email" placeholder="Email" class="form-control" required>
                    <div class="form-icon"><i class="fa fa-envelope"></i></div>
                </div>
            </div>
            
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <div class="form-group service-form-group">
                    <label class="control-label sr-only" for="phone"></label>
                    <input wire:model.lazy="quote.phone" id="phone" data-mask="(00)0-0000-0000" name="phone" type="text" placeholder="WhatsApp" class="form-control" required >
                    <div class="form-icon"><i class="fa fa-phone"></i></div>
                </div>
            </div>
            
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                <div class="form-group service-form-group">
                    <label class="control-label sr-only" for="date"></label>
                    <input wire:model.defer="quote.date" id="date" name="date" data-mask="00/00/0000" type="text" placeholder="Data" class="form-control" required >
                    <div class="form-icon"><i class="fa fa-calendar"></i></div>
                </div>
            </div>
            
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                <div class="form-group service-form-group">
                    <label class="control-label sr-only" for="time"></label>
                    <input wire:model.defer="quote.time" id="time" data-mask="00:00" name="time" type="time" step="1800" placeholder="Horário" class="form-control" required>
                    {{-- <div class="form-icon"><i class="fa fa-clock"></i></div> --}}
                </div>
            </div>
            
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                <div class="form-group service-form-group">
                    <label class="control-label sr-only" for="place"></label>
                    <input wire:model.lazy="quote.place" id="place" name="place" type="text" placeholder="Local" class="form-control" required>
                    <div class="form-icon"><i class="fa fa-location-pin"></i></div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                <div class="form-group service-form-group">
                    <label class="control-label sr-only" for="city"></label>
                    <input wire:model.lazy="quote.city" id="city" name="city" type="text" placeholder="Cidade" class="form-control" required>
                    <div class="form-icon"><i class="fa fa-city"></i></div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="form-group">
                    <label class="control-label sr-only" for="project_id"></label>
                    <div class="select">
                        <select wire:model.lazy="quote.project_id" id="project_id" name="project" class="form-control" required>
                            <option value="">Selecione o projeto</option>
                            @foreach($projects as $project)
                                <option value="{{$project->id}}">{{$project->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>  
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <div class="form-group">
                    <label class="control-label sr-only" for="message"></label>
                    <textarea class="form-control" wire:model.lazy="quote.message" id="message" name="message" rows="3"
                        placeholder="Informações adicionais"></textarea>
                </div>
            </div>
            @if($success)
                <div class="alert alert-success mb-4 col-lg-12" role="alert">
                    {{$success}}
                </div>
            @endif
            @error('quote.*')
            <div class="alert alert-danger mb-4 col-lg-12" role="alert">
                {{$message}}
            </div>
            @enderror
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                <button type="submit" class="btn btn-success btn-block mb10">Solicitar orçamento</button>
            </div>
            
        </div>
    </div>
</form>
@push('scripts')
<script type="text/javascript">
    document.addEventListener('livewire:load', function () {
        $('#date').on('change', function (e) {
            @this.set('quote.date', e.target.value);
        });
        $('#time').on('change', function (e) {
            @this.set('quote.time', e.target.value);
        });
    });  
</script>
<script type="text/javascript">
    $.datetimepicker.setLocale('pt-BR');

    $('#date').datetimepicker({
        'format': 'd/m/Y',
        'timepicker': false,
        'scrollInput': false
    });
    $('#time').datetimepicker({
        'format': 'H:i',
        'datepicker': false,
        step: 30
    });

    
</script>   

@endpush