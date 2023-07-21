<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List News</title>
</head>
<body>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <table>
        <thead>
            <th>No</th>
            <th>Nama Acara</th>
            <th>Tanggal Acara</th>
            <th>Created At</th>
            <th>Action</th>
        </thead>
        <tbody>
            @forelse ($activity as $key => $value)
                <tr>
                    <td>{{ ($activity->currentPage() - 1) * $activity->perPage() + $key + 1 }}</td>
                    <td>{{ $value->title }}</td>
                    <td>{{ $value->tanggal }}</td>
                    <td>{{ $value->created_at }}</td>
                    <td>
                        <a href="#">Edit</a>
                        <a href="#">Delete</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center">Empty Data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div style="text-align: center">
        {{ $activity->links() }}
    </div>
</body>
</html>