@extends('admin.layout.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Contrato de {{$contract->quote->infoString}} </h5>
                </div>
                <div class="card-body">
                    <span>Clique <a target="_blank" href="{{asset('storage/pdf/'.$contract->file)}}">aqui</a> para baixar o contrato</span>
                    @if(auth()->user()) 
                    <form id="upload_contract_form" action="{{route('admin.contracts.upload')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="contract_id" value="{{$contract->id}}">
                        <div class="form-control mt-3">
                            <label for="new_contract" class="form-label">Alterar o contrato</label>
                            <input class="form-control" name="new_contract" type="file" id="new_contract">
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script type="text/javascript">
    $('#new_contract').on('change', function(event) {
        $('#upload_contract_form').submit();
    });
</script>
    
@endpush