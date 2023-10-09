@extends('layout.app', ['page' => 'newHome'])

@section('body')
    @include('components.hero-carousel')
    @include('components.news-carousel')
    @include('components.fastabiqul')
@endsection