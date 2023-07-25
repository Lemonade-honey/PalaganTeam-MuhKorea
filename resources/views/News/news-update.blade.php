<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News Create</title>
</head>
<body>
    @if ($errors->any())
        @foreach ($errors->all() as $item)
            <p>{{ $item }}</p>
        @endforeach
    @endif
    <form method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" id="" value="{{  old('title') ?? $news->title }}">
        <input type="file" name="img-thumbnail" id="" accept="image/png, image/gif, image/jpeg">
        <textarea name="details" id="editor" cols="30" rows="10">
            {{ old('details') ?? $news->details }}
        </textarea>
        <button type="submit">Create</button>
    </form>
</body>
@include('Includes.CKEditor')

</html>