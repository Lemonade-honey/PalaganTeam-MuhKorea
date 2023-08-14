<div class="p-4 sm:ml-64">
    <div class="p-4">
        <div class="flex items-center justify-between py-5">
            <h1 class="font-bold text-blue-800 text-2xl mb-0">Users List</h1>
            <a href="#">
                <button class="bg-blue-600 hover:bg-blue-800 text-white rounded px-2 text-md font-semibold p-1">Add
                    User</button>
            </a>
        </div>
        <hr />
        <div class="pt-3 relative overflow-x-auto">
            <table class="w-full text-xs md:text-sm text-left text-slate-500">
                <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Created At
                        </th>
                        <th scope="col" class="px-6 py-3 float-right">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b">
                        <td class="px-6 py-4">
                            No
                        </td>
                        <td class="px-6 py-4">
                            Nama
                        </td>
                        <td class="px-6 py-4">
                            Email
                        </td>
                        <td class="px-6 py-4">
                            Asal
                        </td>
                        <td class="px-6 py-4">
                            created at
                        </td>
                        <td class="float-right">
                            <div class="flex flex-row space-x-2">
                                <a href="#" type="button"
                                    class="bg-yellow-500  hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                    Edit
                                </a>
                                <form action="#" method="POST"
                                    onsubmit="return confirm('Apakah anda ingin menghapus Survei ini?')" type="button">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-3.5 rounded">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
