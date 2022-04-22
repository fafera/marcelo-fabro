<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Marcelo Fabro - Produção Musical">
  <meta name="author" content="Fafa Capellari">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- MS Tile - for Microsoft apps-->
  <meta name="msapplication-TileImage" content="{{asset('img/site.png')}}">    

  <!-- fb & Whatsapp -->

  <!-- Site Name, Title, and Description to be displayed -->
  <meta property="og:site_name" content="Marcelo Fabro - Produção Musical">
  <meta property="og:title" content="Marcelo Fabro - Produção Musical para Eventos Marcantes">
  <meta property="og:description" content="Marcelo Fabro - Produção Musical é a garantia de um evento marcante com momentos encantadores e inesquecíveis embaladas por um repertório totalmente elaborado de acordo com seu gosto.">

  <!-- Image to display -->
  <!-- Replace   «example.com/image01.jpg» with your own -->
  <meta property="og:image" content="{{asset('img/site.png')}}">

  <!-- No need to change anything here -->
  <meta property="og:type" content="website" />
  <meta property="og:image:type" content="image/jpeg">

  <!-- Size of image. Any size up to 300. Anything above 300px will not work in WhatsApp -->
  <meta property="og:image:width" content="300">
  <meta property="og:image:height" content="300">

  <!-- Website to visit when clicked in fb or WhatsApp-->
  <meta property="og:url" content="https://marcelofabro.com">
  <title>{{config('app.name')}}</title>

  <link rel="shortcut icon" href="{{asset('img/fav-marcelo.ico')}}" type="image/x-icon">
  <link rel="icon" href="{{asset('img/fav-marcelo.ico')}}" type="image/x-icon">
  @livewireStyles
  @include('front.components.css')
</head>
<body id="page-top">
    @include('front.components.nav')
    @yield('content')
    @include('front.components.js')
    @stack('scripts')
    @livewireScripts
</body>
