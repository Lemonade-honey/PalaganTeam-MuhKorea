<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Private Form</title>
</head>
<body>
    @if ($errors->any())
        <p>{{ $errors->first() }}</p>
    @endif
    <form action="{{ route('form.formPassword', ['slug' => $slug]) }}" method="post">
        @csrf
        <input type="text" name="password" id="" placeholder="password form">
        <button type="submit">Masuk</button>
    </form>
</body>
</html>