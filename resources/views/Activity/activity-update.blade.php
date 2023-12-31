@extends('layout.dashboard', ['title' => 'Edit Activity'])

@section('body')
@if ($errors->any())
    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200" role="alert">
        {{ $errors->first() }}
    </div>
@endif

<form method="post" action="{{ route('activity.postUpdate', ['id' => $activity->id]) }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-6">
        <label for="title" class="block mb-2 text-md font-medium text-gray-900">Title Activity <span class="text-red">(Max 200)</span></label>
        <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('title') ?? $activity->title }}">
    </div>

    <div class="mb-6">
        <label for="tanggal" class="block mb-2 text-md font-medium text-gray-900">Tanggal</label>
        <input type="date" name="tanggal" id="tanggal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('tanggal') ?? $activity->tanggal }}">
    </div>

    <div class="flex flex-row gap-6 mb-6">
        <div class="w-full">
            <label for="time_start" class="block mb-2 text-md font-medium text-gray-900">Time Start</label>
            <input type="time" name="time_start" id="time_start" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('time_start') ?? $activity->details['time-start'] }}">
        </div>
        <div class="w-full">
            <label for="time_finish" class="block mb-2 text-md font-medium text-gray-900">Time Finish</label>
            <input type="time" name="time_finish" id="time_finish" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('time_finish') ?? $activity->details['time-finish']}}">
        </div>
    </div>
    
    <div class="mb-6">
        <label for="editor" class="block mb-2 text-md font-medium text-gray-900">Details Activity</label>
        <textarea name="details" id="editor" cols="30" rows="10">{{ old('details') ?? $activity->details['details'] }}</textarea>
    </div>

    <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1 float-right mb-6">Update Activity</button>
</form>
@include('Includes.MinCKEditor')

@endsection