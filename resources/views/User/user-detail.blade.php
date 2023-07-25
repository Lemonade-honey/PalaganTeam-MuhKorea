<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Details</title>
</head>
<body>
    <p>Nama Lengkap</p>
    <input type="text" name="name" id="" value="{{ $user->name }}" disabled>
    <p>Email</p>
    <input type="email" id="" value="{{ $user->email }}" disabled>
    <p>Verified</p>
    <input type="text" id="" value="{{ $user->email_verified_at ?? 'null' }}" disabled>
    <p>Role Access</p>
    <input type="text" name="" id="" value="{{ $user->role }}" disabled>
    <p>Created At</p>
    <input type="text" id="" value="{{ $user->created_at }}" disabled>
    <a href="{{ route('users.update', ['id' => $user->id]) }}">Edit</a>
</body>
</html>