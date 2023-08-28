<section class="mt-10 my-4 lg:p-10 px-10" id="activities">
    <h1 class="text-2xl sm:text-4xl text-center font-bold text-emerald-600 mb-3">Our Activities</h1>
    <div class="w-full {{ (count($activity) <= 1 ) ? '' : 'overflow-x-scroll' }} flex {{ (count($activity) == 1) ? 'justify-center' : ''}} gap-4">

        @forelse ($activity as $key => $value)
        <div class="overflow-y-scroll overflow-x-hidden max-w-xs min-width max-h-96 border border-gray-200 hover:border-blue-400 ease-in duration-200 rounded-md min-h-[20rem] p-4" id="{{ Str::slug($value->title) }}">
            
            @if (date("H:i a", strtotime($value->details['time-finish'])) > date("H:i a", strtotime(now())) && date("d", strtotime($value->tanggal)) == date("d", strtotime(now())) && date("H:i a", strtotime($value->details['time-start'])) <= date("H:i a", strtotime(now())))
            <div class="flex items-center text-sm text-emerald-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="text-emerald-600 inline align-middle mr-1" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                </svg><p class="text-emerald-500 font-medium">Started</p>
            </div>
            @elseif(date("d", strtotime($value->tanggal)) == date("d", strtotime(now())) && date("H:i a", strtotime($value->details['time-finish'])) < date("H:i a", strtotime(now())))
            <div class="flex items-center text-sm text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="text-gray-800 inline align-middle mr-1" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                </svg><p class="text-red-500">Finished</p>
            </div>
            @endif

            <!-- tanggal -->
            <p class="text-sm font-medium">{{ (date('d M', strtotime($value->tanggal)) == date('d M', strtotime(now()))) ? '' : date('M d,', strtotime($value->tanggal)) }} {{ date('H:i', strtotime($value->details['time-start'])) }} - {{ date('H:i a', strtotime($value->details['time-finish'])) }}
            
            </p>
            <h2 class="text-xl font-bold text-emerald-600 mb-2 capitalize">{{ $value->title }}</h2>
            <div class="content" id="details">
                <?= $value->details['details'] ?>
            </div>
        </div>
        @empty

        <div class="w-full max-w-xs flex flex-col justify-center items-center">
            <img src="/image/tidak-ada-agenda.png" alt="">
            <p class="text-lg font-medium text-gray-300">No activity in this week</p>
        </div>
        @endforelse
        

    </div>
</section>
<hr class="mt-16">