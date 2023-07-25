<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Activity Create</title>
</head>
<body>
    @if ($errors->any())
        <p style="color: red">{{ $errors->first() }}</p>
    @endif
    <form method="post" action="{{ route('activity.postUpdate', ['id' => $activity->id]) }}" enctype="multipart/form-data">
        @csrf
        <p>title</p>
        <input type="text" name="title" id="" placeholder="title" value="{{ old('title') ?? $activity->title }}">
        <p>tanggal</p>
        <input type="date" name="tanggal" id="" placeholder="tanggal" value="{{ old('tanggal') ?? $activity->tanggal }}">
        <p>time start</p>
        <input type="time" name="time_start" id="" placeholder="time_start" value="{{ old('time_start') ?? $activity->details['time-start'] }}">
        <p>time finish</p>
        <input type="time" name="time_finish" id="" placeholder="time_end" value="{{ old('time_finish') ?? $activity->details['time-finish']}}">
        <p>details</p>
        <textarea name="details" id="editor" cols="30" rows="10">{{ old('details') ?? $activity->details['details'] }}</textarea>
        <button type="submit">Create</button>
    </form>
</body>
@include('Includes.MinCKEditor')

</html>