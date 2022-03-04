@extends('front.layout.app')
@section('content')
  @include('front.components.header')
  @include('front.sections.about')
  @include('front.sections.projects')
  @include('front.sections.request_quote')
@endsection