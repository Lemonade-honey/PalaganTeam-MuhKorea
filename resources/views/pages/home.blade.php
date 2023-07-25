@extends('layout.app')

@section('body')
    @include('components.hero-carousel')


    @include('components.hero')


    @include('components.visimisi')


    @include('components.news-carousel')


    @include('components.location')


    @include('layout.footer')
@endsection


{{-- @section('body')
    @include('pages.blog-news.blog-home')
    @include('pages.blog-news.blog-page')
@endsection --}}
