<div class="row">
    <div class="col-lg-12">
        <button id="btn-export" data-href="{{route('admin.songbooks.export', $songbook->id)}}" class="btn btn-primary float-lg-right">Gerar PDF</button>
    </div>
</div>
<div>
    <h6 class="mb-3">Músicas cadastradas neste repertório:</h6>
    @foreach($list as $item) 
        <p><a target="_blank" style="color:#252422; text-decoration:none;" href="{{route('admin.songs.show', $item->id)}}">{{$item->title}} - {{$item->performer}}</a></p>
    @endforeach
</div>
@push('scripts')
    <script type="text/javascript">
        $('#btn-export').on('click', function() {
            //window.location.href = $(this).data('href');
            window.open($(this).data('href'), '_blank');
        });
    </script>
@endpush