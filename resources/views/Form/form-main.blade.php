@extends('layout.dashboard', ['title' => 'Main Forms'])

@section('body')

<div class="p-4">
    @if (Auth::user()->role == "admin" || Auth::user()->role == "staf")
    <a href="{{ route('form.subForm.create', ['slug' => $form->slug]) }}">
        <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 float-right mb-4">Add Sub From</button>
    </a>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="mb-6">
        <h2 id="accordion-collapse-heading-1">
            <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-300 rounded-t-xl bg-gray-100">
                <span class="capitalize">{{ $form->title }}</span>
            </button>
        </h2>
        <div class="p-5 border border-gray-200 dark:border-gray-700 dark:bg-gray-900">
            <?= $form->desc ?>
        </div>
    </div>

    <div class="sub-form">
        
        @forelse ($sub_form as $value)
        <a href="{{ route('form.subForm', ['slug' => $form->slug, 'sub_slug' => $value->slug]) }}">
            <div class="w-full p-5 font-medium text-left text-gray-500 border rounded-xl border-gray-300 hover:bg-gray-100 mb-4">
                <p class="text-xs">{{ date("H:i, d M Y", strtotime($value->created_at)) }}</p>
                <p>{{ $value->title }}</p>
            </div>
        </a>

        @empty

        <div class="p-5 font-medium text-center text-gray-500 border rounded-xl border-gray-300">No sub form added</div>
        @endforelse
        
    </div>

    @include('Includes.Comment2', ['comment' => $form, 'title' => 'Discussion'])
</div>
  
@endsection