<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Update</title>
</head>
<body>
    <form method="post" action="{{ route('users.postUpdate', ['id' => $user->id]) }}">
        @csrf
        <p>Nama Lengkap</p>
        <input type="text" name="name" id="" value="{{ $user->name }}">
        <p>Email</p>
        <input type="email" id="" value="{{ $user->email }}" disabled>
        <p>Verified</p>
        <input type="text" name="" id="" value="{{ $user->email_verified_at ?? 'null' }}" disabled>
        <p>Role Access</p>
        <select name="role" id="">
            <option value="{{ $user->role }}" selected>{{ $user->role }}</option>
            <option value="user">user</option>
            <option value="staf">staf</option>
            <option value="admin">admin</option>
        </select>
        <p>Created At</p>
        <input type="text" id="" value="{{ $user->created_at }}" disabled>
        <button type="submit">Update</button>
    </form>
</body>
</html>