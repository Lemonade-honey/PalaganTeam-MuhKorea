@extends('layout.dashboard')

@section('body')
<main>
    <h1 class="text-3xl mb-1 text-blue-700">Hi, How are you today ?</h1>
    <p class="text-lg">Hopefully in good day and healthy</p>

    <hr class="my-8">

    <div class="container gap-x-20 lg:flex">
        <div class="row lg:w-3/6 mb-10">
            
            @if (Auth::user()->role == 'admin')
            <h2 class="text-2xl font-bold mb-4">Stats</h2>
            <div class="flex gap-5 mb-5">
                <div class="w-full p-4 bg-yellow-100 rounded-xl text-gray-800">
                    <div class="font-bold text-2xl leading-none">{{ $totalUser }}</div>
                    <div class="mt-2">User Active</div>
                </div>
                <div class="w-full p-4 bg-yellow-100 rounded-xl text-gray-800">
                    <div class="font-bold text-2xl leading-none">{{ $totalForm }}</div>
                    <div class="mt-2">Forms Active</div>
                </div>
            </div>

            @else
            <div class="flex items-center justify-between">
                <h2 class="text-2xl text-blue-700 font-bold mb-4">My Forms</h2>
            </div>
            <div class="space-y-4">
                @forelse ($forms as $key => $value)
                    @if ($key < 5)
                        <div class="p-4 {{ ($value->status == 'private') ? 'bg-orange-200' : 'bg-blue-200' }} border rounded-xl text-gray-800 space-y-2">
                            <div class="flex justify-between">
                                <div class="text-black text-lg capitalize">{{ $value->status }}</div>
                            </div>
                            <a href="{{ route('form.mainForm', ['slug' => $value->slug]) }}" class="font-bold hover:text-yellow-800 capitalize hover:underline">{{ $value->title }}</a>
                        </div>
                        @if(count($forms) == $key + 1)
                            <a href="#" class="float-right text-blue-500 hover:text-blue-700 underline">See all my form</a>
                        @endif
                    @endif
                @empty
                    <!-- Empty -->
                    <div class="py-10 bg-white border rounded-xl text-gray-800 space-y-2">
                        <p class="text-center text-lg">No Form Joined</p>
                    </div>
                @endforelse
            </div>
            @endif
        </div>

        <div class="row lg:w-3/6">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-blue-700 mb-4">Activity This Week ({{ count($activitys) ?? 0 }})</h2>
                <p>{{ date("d, M") }}</p>
            </div>
            <div class="space-y-4 {{ (count($activitys) > 4) ? 'overflow-x-hidden' : '' }} h-96">
                @forelse ($activitys as $key => $value)
                <div class="p-4 bg-white border rounded-xl text-gray-800 space-y-2">
                    <div class="flex justify-between">
                        <div class="text-gray-400 text-lg">{{ date("l, d", strtotime($value->tanggal)) }}</div>
                        <div class="text-gray-400 text-xs">{{ date("H:i a", strtotime($value->details['time-start'])) }}</div>
                    </div>
                    <a href="/#{{ Str::slug($value->title) }}" class="font-bold hover:text-yellow-800 hover:underline capitalize">{{ $value->title }}</a>

                    @if (date("H:i a", strtotime($value->details['time-finish'])) > date("H:i a", strtotime(now())) && date("d", strtotime($value->tanggal)) == date("d", strtotime(now())) && date("H:i a", strtotime($value->details['time-start'])) <= date("H:i a", strtotime(now())))
                    <div class="flex items-center text-sm text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="text-gray-800 inline align-middle mr-1" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                        </svg><p>Started</p>
                    </div>
                    @elseif(date("d", strtotime($value->tanggal)) == date("d", strtotime(now())) && date("H:i a", strtotime($value->details['time-finish'])) < date("H:i a", strtotime(now())))
                    <div class="flex items-center text-sm text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="text-gray-800 inline align-middle mr-1" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                        </svg><p class="text-red-500">Finished</p>
                    </div>
                    @endif
                </div>
                @empty
                <div class="py-10 bg-white border rounded-xl text-gray-800 space-y-2">
                    <p class="text-center text-lg">No activity on this week</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <hr class="my-8">
</main>
@endsection