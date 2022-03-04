<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">

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
