@extends('layout.app', ['title' => ucwords($form->title), 'page' => 'form'])

@section('body')
<p>Title : {{ $form->title }}</p>

@include('Includes.Comment', ['comment' => $form])
@endsection