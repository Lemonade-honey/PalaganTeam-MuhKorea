<section class="mt-10 my-4 lg:p-10" id="activities">
    <h1 class="text-2xl sm:text-4xl text-center font-bold text-emerald-600 mb-3">Our Activities</h1>
    <div class="w-full {{ (count($activity) == 0) ? '' : 'overflow-x-scroll' }} flex {{ (count($activity) <= 2) ? 'justify-center' : ''}} gap-4">

        @forelse ($activity as $key => $value)
        <div class="overflow-y-scroll w-full max-w-xs min-width max-h-96 border border-gray-200 hover:border-blue-400 ease-in duration-200 rounded-md min-h-[20rem] p-4" id="test">
            <p class="text-base capitalize text-blue-500">started</p>
            <!-- tanggal -->
            <p class="text-sm font-medium">{{ date('H:i', strtotime($value->details['time-start'])) }} - {{ date('H:i a', strtotime($value->details['time-finish'])) }}{{ (date('d M', strtotime($value->tanggal)) == date('d M', strtotime(now()))) ? '' : date(', M d', strtotime($value->tanggal)) }}
            
            </p>
            <h2 class="text-xl font-bold text-emerald-600 mb-2">{{ $value->title }}</h2>
            <div class="content" id="details">
                <?= $value->details['details'] ?>
            </div>
        </div>
        @empty

        <div class="w-full text-center border border-gray-200 p-4">
            no activity
        </div>
        @endforelse
        

    </div>
</section>
<hr class="mt-16">