<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title>
</head>
<body>
    <p>Title</p>
    <p>{{ $form->title }}</p>

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @elseif(session()->has('errors'))
        <div class="alert alert-danger">
            {{ session()->get('errors') }}
        </div>
    @endif
    <p style="margin-top: 3rem">Komentar</p>
    @if ($form->id_massage)
        @if ($form->massage_box != null)
            <div class="batas" style="max-width: 40rem, width: 100%">
                @foreach ($form->massage_box as $item)
                    <div class="block">
                        <p>{{ $item['by'] }}</p>
                        <p>{{ $item['massage'] }}, {{ date('H:i, d F Y', strtotime($item['time'])) }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p>Jadi yang pertama kali berkomentar</p>
        @endif
        <form action="{{ route('massage.store', ['id' => $form->id_massage, 'slug' => $form->slug]) }}" method="POST">
            @csrf
            <textarea name="massage" id="editor" cols="30" rows="3">{{ old('details') }}</textarea>
            <button type="submit">Post</button>
        </form>
    @endif
</body>
</html>