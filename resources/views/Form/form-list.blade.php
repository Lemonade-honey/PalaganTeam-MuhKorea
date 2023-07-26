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
    @elseif(session()->has('errors'))
        <div class="alert alert-danger">
            {{ session()->get('errors') }}
        </div>
    @endif
    <table>
        <thead>
            <th>No</th>
            <th>Judul Form</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Action</th>
        </thead>
        <tbody>
            @forelse ($form as $key => $value)
                <tr>
                    <td>{{ ($form->currentPage() - 1) * $form->perPage() + $key + 1 }}</td>
                    <td>{{ $value->title }}</td>
                    <td>{{ $value->status }}</td>
                    <td>{{ date('d F Y, H:i', strtotime($value->created_at)) }}</td>
                    <td>
                        <a href="{{ route('form.update', ['slug' => $value->slug]) }}">Edit</a>
                        <a href="#">Delete</a>
                    </td>
                </tr>
            @empty
                <td colspan="5">Data Tidak Ditemukan</td>
            @endforelse
        </tbody>
    </table>
    <div style="text-align: center">
        {{ $form->links() }}
    </div>
</body>
</html>