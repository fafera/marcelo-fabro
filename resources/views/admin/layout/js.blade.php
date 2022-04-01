<script src="{{asset('js/admin/core/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/admin/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/admin/core/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/admin/plugins/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>


<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="{{asset('js/admin/plugins/jquery.dataTables.min.js')}}"></script>

<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!-- Chart JS -->
<script src="{{asset('js/admin/plugins/chartjs.min.js')}}"></script>

<!--  Notifications Plugin    -->
<script src="{{asset('js/admin/plugins/bootstrap-notify.js')}}"></script>

<!-- Control Center for Paper Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('js/admin/paper-dashboard.js?v=2.0.0')}}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/classic/ckeditor.js"></script>
<script>
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});    
</script>