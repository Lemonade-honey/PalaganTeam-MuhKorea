<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>Role</th>
            <th>Verified</th>
            <th>Action</th>
        </thead>
        <tbody>
            @forelse ($users as $key => $value)
                <tr>
                    <td>{{ ($users->currentPage() - 1) * $users->perPage() + $key + 1 }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->role }}</td>
                    <td>{{ $value->email_verified_at }}</td>
                    <td>
                        <a href="{{ route('users.details', ['id' => $value->id]) }}">View</a>
                        {{-- <a href="{{ route('users.delete', ['id' => $value->id]) }}" id="delete">Delete</a> --}}
                        <a href="#" id="delete" dataGet="{{ $value->id }}">Delete</a>
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
        {{ $users->links() }}
    </div>
    <script>
        const deleletBtn = document.querySelectorAll('#delete');
        deleletBtn.forEach(element => {
            element.addEventListener('click', () => {
                Swal.fire({
                    title: 'Are you sure to delete it?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/dashboard/users/delete/' + element.getAttribute('dataGet')
                }
            })
        })
        });
    </script>
</body>
</html>