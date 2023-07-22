@extends('layout.app')

@section('body')
    {{-- Hero Carousel Section --}}
    @include('components.hero-carousel')
    {{--  --}}

    {{-- Hero Section --}}
    @include('components.hero')
    {{--  --}}

    {{-- Visi dan Misi Section --}}
    @include('components.visimisi')
    {{--  --}}

    {{-- News Carousel Section --}}
    @include('components.news-carousel')
    {{--  --}}
@endsection
