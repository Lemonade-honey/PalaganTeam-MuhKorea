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
            <th>Nama Berita</th>
            <th>Author</th>
            <th>Created</th>
            <th>Action</th>
        </thead>
        <tbody>
            @forelse ($news as $key => $value)
                <tr>
                    <td>{{ ($news->currentPage() - 1) * $news->perPage() + $key + 1 }}</td>
                    <td>{{ $value->title }}</td>
                    <td>{{ $value->created_by }}</td>
                    <td>{{ date('d F Y, H:i:s', strtotime($value->created_at)) }}</td>
                    <td><a href="{{ route('news.update', ['slug' => $value->slug]) }}">Edit</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center">Empty Data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div style="text-align: center">
        {{ $news->links() }}
    </div>
</body>
</html>