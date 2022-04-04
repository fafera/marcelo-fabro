<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $title }}</title>
    <style>
        span.nbsp {
            display: inline-block;
            width: 70px;
        }

        p {
            text-align: justify;
            font-size:20px;
        }

        .page_break {
            page-break-before: always;
        }

        .logo {
            width: 300px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

    </style>
</head>

<body style="padding: 30px">
    <div style="text-align: center">
        <img src="{{asset('img/logo-preto.png')}}" alt="" class="logo">
    </div>      
    {{-- <img class="logo" src="{{asset('img/logo-preto.png')}}"/> --}}
    <h1 style="text-align: center; font-size:35px">{{$title}}</h1>
    <hr>
    @foreach($songs as $song)
        @if(is_array($song)) 
            <p> {{$song['title']}} - {{$song['performer']}}</p>
        @else
            <p> {{$song->title}} - {{$song->performer}} </p>
        @endif
    @endforeach

</body>

</html>
