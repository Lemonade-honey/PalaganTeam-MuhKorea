<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form List Member</title>
</head>
<body>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @elseif(session()->has('errors'))
        <div class="alert alert-danger">
            {{ session()->get('errors') }}
        </div>
    @endif
    <table>
        <thead>
            <th>No</th>
            <th>Email</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @forelse ($member as $item)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item }}</td>
                    <td>
                        <a href="{{ route('form.list.member.delete', ['slug' => $slug, 'email' => $item]) }}">Delete</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Tidak ada Member Terdaftar</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>