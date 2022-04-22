<!-- Header -->
{{-- <header class="masthead">
    <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
            <img class="img-responsive" src="{{asset('img/logo-branco.png')}}" style="display:block;max-height:400px;height:auto;max-width: 100% ">
            <div class="clearfix"></div>
            <a class="ct-btn-scroll ct-js-btn-scroll js-scroll-trigger" href="#about"><img height="75px" width="75px" alt="Arrow Down Icon" src="{{asset('img/arrow-down.jpg')}}"></a>
        </div>
    </div>
</header> --}}
<header class="video-background">

    <!-- This div is  intentionally blank. It creates the transparent black overlay over the video which you can modify in the CSS -->
    <div class="overlay"></div>
    <video id="video-intro" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
        <source src="{{asset('intro.mp4')}}" type="video/mp4">
      </video>
    <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
            <img class="img-responsive" src="{{asset('img/logo-branco.png')}}" style="display:block;max-height:400px;height:auto;max-width: 100% ">
            <div class="clearfix"></div>
            <a class="ct-btn-scroll ct-js-btn-scroll js-scroll-trigger" href="#about"><img height="75px" width="75px" alt="Arrow Down Icon" src="{{asset('img/arrow-down.jpg')}}"></a>
        </div>
    </div>
    <!-- The HTML5 video element that will create the background video on the header -->
    
  
   
  </header>