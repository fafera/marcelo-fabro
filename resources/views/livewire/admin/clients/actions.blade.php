<div>
    <div class="row">
        <div class="col-lg-12 mb-2 p-3">
            @if(!empty($quoteButton))
                <a target="_blank" href="{{$quoteButton['route']}}" class="btn {{$quoteButton['class']}}">{{$quoteButton['text']}}</a>
            @endif
            @if(!empty($contractButton))
                <a target="_blank" href="{{$contractButton['route']}}" class="btn {{$contractButton['class']}}">{{$contractButton['text']}}</a>
            @endif
            @if(!empty($eventPageButton))
                <a target="_blank" id="event-page-button" href="{{$eventPageButton['route']}}" class="btn {{$eventPageButton['class']}}">{{$eventPageButton['text']}}</a>
            @endif
            @if(!empty($setlistButton))
                <a target="_blank" href="{{$setlistButton['route']}}" class="btn {{$setlistButton['class']}}">{{$setlistButton['text']}}</a>
            @endif
            @if(!empty($paymentButton))
                <a target="_blank" id="payment-button" href="{{$paymentButton['route']}}" class="btn {{$paymentButton['class']}}">{{$paymentButton['text']}}</a>
            @endif
            
        </div>
    </div>
    <livewire:admin.clients.event-page-modal :client="$client" />
    @if($client->contract != null)
        <livewire:admin.payments.modal :contract="$client->contract" />
    @endif
</div>
@push('scripts')
    <script type="text/javascript">
        $('#event-page-button').on('click', function(event){
            event.preventDefault();
            $('#event-page-modal').modal('show');
        });
        $('#payment-button').on('click', function(event){
            event.preventDefault();
            $('#payment-modal').modal('show');
        });
        // window.addEventListener('closeEventPageModal', event => {
        //     $("#event-page-modal").find('form').trigger('reset');
        //     $("#event-page-modal").modal('hide');
        // });
            
    </script>
@endpush