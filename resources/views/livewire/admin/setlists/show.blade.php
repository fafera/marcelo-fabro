<div>
    <div class="card-header">
        <small>Repertório:</small>
        <h5 class="card-title">{{ $quote->infoString }}</h5>
    </div>
    <div class="card-body">
        @foreach ($quote->setlist as $item)
            <div class="mb-4">
                <h6> {{ $item->moment->title }}:</h6>
                <span>{{$item->song->title}} - {{$item->song->performer}}</span>
            </div>
        @endforeach
    </div>
</div>
