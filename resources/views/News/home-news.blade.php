@extends('layout.app', ['page' => 'news'])

@section('body')
    {{-- @include('components.news-carousel') --}}
    @include('News.news-page')
@endsection
