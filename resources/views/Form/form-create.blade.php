<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Create</title>
</head>
<body>
    @if ($errors->any())
        <p>{{ $errors->first() }}</p>
    @endif
    <form action="" method="post">
        @csrf
        <p>Form Title</p>
        <input type="text" name="title" id="">
        <p>Form Description (max 100)</p>
        <input type="text" name="desc" id="">
        <p>Form Massage ?</p>
        <input type="checkbox" name="form-massage" id="" checked>
        <p>Form Public ?</p>
        <select name="status_form" id="">
            <option value="public" selected>Public</option>
            <option value="private">Private</option>
        </select>
        <p>Password Form</p>
        <input type="text" name="password" id="">
        <p>Form Details</p>
        <textarea name="details" id="editor" cols="30" rows="10">{{ old('details') }}</textarea>
        <button type="submit">Create</button>
    </form>
</body>
@include('Includes.CKEditor')

</html>