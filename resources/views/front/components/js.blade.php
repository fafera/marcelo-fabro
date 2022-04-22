<!-- Bootstrap core JavaScript -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<!-- Plugin JavaScript -->
<script src="{{asset('js/jquery.easing.min.js')}}"></script>
<!-- Custom scripts for this template -->
<script src="{{asset('js/main.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script type="text/javascript">
    $('.orcamento-btn').on('click',function() {
        window.open('https://api.whatsapp.com/send?phone=555481181288&text=SOLICITAÇÃO%20DE%20ORÇAMENTO', '_blank');
    });
    $('#facebook').on('click',function() {
        window.open('https://www.facebook.com/marcelofabromusic', '_blank');
    });
    $('#instagram').on('click',function() {
        window.open('https://www.instagram.com/marcelofabromusic', '_blank');
    });
    $('#email').on('click',function() {
        window.open('mailto:marcelofabromusic@gmail.com?Subject=Contato%20pelo%20site');
    });
    var played = false
    var audio = new Audio("../audio.mp3");
    $('#sound-play').on('click', function(e) {
        e.preventDefault();
        if(played == false) {
            played = true;
            $('#sound-play i').addClass('fa-pause').removeClass('fa-play');
            audio.play();
        } else {
            played = false;
            $('#sound-play i').addClass('fa-play').removeClass('fa-pause');
            audio.pause();
        }
    });
    $(window).scroll(function() {
        
    });
</script>