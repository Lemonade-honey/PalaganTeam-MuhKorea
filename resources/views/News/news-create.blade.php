<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News Create</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" id="">
        <textarea name="temp" id="temp" cols="30" rows="10" style=""></textarea>
        <textarea name="details" id="editor" cols="30" rows="10">{{ old('details') }}</textarea>
        <button type="submit">Create</button>
    </form>
</body>
@include('Includes.CKEditor')

</html>