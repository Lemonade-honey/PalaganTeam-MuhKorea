@extends('layout.dashboard', ['title' => $sub_form->title])

@section('body')

<div class="p-4 sm:mr-64">
    <div class="h-96">
        <div class="judul mb-5">
            <p class="text-2xl mb-2 capitalize">{{$sub_form->title}}</p>
            <p class="text-sm text-gray-500 capitalize">{{ $sub_form->created_by }} - {{ date("d M Y", strtotime($sub_form->created_at)) }}</p>

            <nav class="flex mt-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 ">
                    <li>
                        <div class="flex items-center">
                        <a href="{{ route('form.mainForm', ['slug' => $form->slug]) }}" class="text-sm font-medium text-gray-700 hover:text-blue-600">Home</a>
                        </div>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2 capitalize">{{$sub_form->title}}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <hr class="my-2">
        </div>
        <div class="content">
            <?= $sub_form->details ?>
        </div>
    </div>
    
    @include('Includes.Comment2', ['comment' => $sub_form, 'title' => 'Discussion'])
</div>

@endsection