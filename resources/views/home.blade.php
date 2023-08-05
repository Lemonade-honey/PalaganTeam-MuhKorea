@extends('layout.app', ['page' => 'home'])

@section('body')
    @include('components.hero-carousel')


    @include('components.hero')


    @include('components.visimisi')


    @include('components.news-carousel')


    @include('components.activity-carousel')


    @include('components.location')
@endsection


{{-- @section('body')
    @include('pages.blog-news.blog-home')
    @include('pages.blog-news.blog-page')
@endsection --}}
