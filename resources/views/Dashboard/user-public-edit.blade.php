@extends('layout.dashboard')

@section('body')
<form action="" method="post">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 w-full">

        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow">
            <div class="flex items-center gap-2">
                <div class="relative inline-flex items-center justify-center w-14 h-14 overflow-hidden bg-gray-100 rounded-full">
                    <span class="font-medium text-gray-600 uppercase">{{ substr($user->name, 0, 2) }}</span>
                </div>
                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 capitalize break-words">{{ $user->name }}</h5>
            </div>
            <hr class="mt-2">

            <div class="data-profile">
                <div class="my-2">
                    <p for="email" class="text-sm font-extralight">Email Address</p>
                    <p class="break-words">{{ $user->email }}</p>
                </div>
                <div class="my-2">
                    <p for="hp" class="text-sm font-extralight">Handphone</p>
                    <input type="number" name="handphone" id="" value="{{ old('handphone') ?? $user->handphone ?? '' }}">
                </div>
                <div class="my-2">
                    <p class="text-sm font-extralight">Home Address</p>
                    <textarea name="address" id="" class="w-full rounded-sm p-1" rows="5">{{ old('address') ?? $user->address }}</textarea>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow">
            <div class="skills" id="skills">
                <div class="flex gap-2 mb-2">
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 capitalize">Skills</h5>
                    <button type="button" id="tmbSkill" class="px-3 py-2 text-xs font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">Tambah</button>
                </div>
                @foreach ($data['skill'] as $item)
                <div class="mb-2">
                    <input type="text" class="w-full" name="skill[]" value="{{ $item }}">
                    <button type="button" id="hapus-skill" class="px-3 py-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">hapus</button>
                </div>
                @endforeach
            </div>

            <div class="hobbys mt-4" id="hobbys">
                <div class="flex gap-2 mb-2">
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 capitalize">Hobbies</h5>
                    <button type="button" id="tmbHobbys" class="px-3 py-2 text-xs font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">Tambah</button>
                </div>
                @foreach ($data['hobby'] as $item)
                <div class="mb-2">
                    <input type="text" class="w-full" name="hobbys[]" value="{{ $item }}">
                    <button type="button" id="hapus-hobby" class="px-3 py-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">hapus</button>
                </div>
                @endforeach
            </div>

        </div>
        
    </div>
    <div class="flex justify-end mt-2 gap-2">
        <a href="#" class="px-3 py-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">Cancel</a>
        <button type="submit" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">Update</button>
    </div>

</form>

@endsection


@section('script')
<script>
    const tmbSkill = document.getElementById('tmbSkill')
    tmbSkill.addEventListener('click', () => {
        const field = ml('div', {class: 'mb-2'}, [
            ml('input', {class: 'w-full', type: 'text', name:'skill[]'}, ),
            ml('button', {type: 'button', id:'hapus-skill', class: 'px-3 py-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300'}, 'hapus')
        ])

        const target = document.getElementById('skills')
        target.appendChild(field)
    })

    const tmbHobbys = document.getElementById('tmbHobbys')
    tmbHobbys.addEventListener('click', () => {
        const field = ml('div', {class: 'mb-2'}, [
            ml('input', {class: 'w-full', type: 'text', name:'hobbys[]'}, ),
            ml('button', {type: 'button', id:'hapus-hobby', class: 'px-3 py-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300'}, 'hapus')
        ])

        const target = document.getElementById('hobbys')
        target.appendChild(field)
    })

    setInterval(() => {
        const hpsSkill = document.querySelectorAll('#hapus-skill')
        hpsSkill.forEach(element => {
            element.addEventListener('click', () => {
                element.parentNode.remove()
            })
        });

        const hpsHobby = document.querySelectorAll('#hapus-hobby')
        hpsHobby.forEach(element => {
            element.addEventListener('click', () => {
                element.parentNode.remove()
            })
        });
    }, 1000);
</script>
@endsection