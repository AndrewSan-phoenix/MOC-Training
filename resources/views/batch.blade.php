@extends('branding.layouts')

@section('content')

@vite(['resources/css/app.css', 'resources/js/app.js'])
<link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Inter:wght@400;700&display=swap" rel="stylesheet">

<section class="relative py-16 bg-gradient-to-r from-blue-800 to-blue-600">
    <div class="absolute inset-0 overflow-hidden">
        <svg id="wave" style="transform:rotate(180deg); transition: 0.3s" viewBox="0 0 1440 390" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(0, 11.511, 223.445, 1)" offset="0%"></stop><stop stop-color="rgba(167.659, 182.451, 225.722, 1)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,117L48,123.5C96,130,192,143,288,169C384,195,480,234,576,227.5C672,221,768,169,864,182C960,195,1056,273,1152,266.5C1248,260,1344,169,1440,117C1536,65,1632,52,1728,52C1824,52,1920,65,2016,58.5C2112,52,2208,26,2304,26C2400,26,2496,52,2592,97.5C2688,143,2784,208,2880,208C2976,208,3072,143,3168,136.5C3264,130,3360,182,3456,208C3552,234,3648,234,3744,221C3840,208,3936,182,4032,156C4128,130,4224,104,4320,97.5C4416,91,4512,104,4608,143C4704,182,4800,247,4896,240.5C4992,234,5088,156,5184,130C5280,104,5376,130,5472,130C5568,130,5664,104,5760,130C5856,156,5952,234,6048,279.5C6144,325,6240,338,6336,286C6432,234,6528,117,6624,97.5C6720,78,6816,156,6864,195L6912,234L6912,390L6864,390C6816,390,6720,390,6624,390C6528,390,6432,390,6336,390C6240,390,6144,390,6048,390C5952,390,5856,390,5760,390C5664,390,5568,390,5472,390C5376,390,5280,390,5184,390,5088,390,4992,390,4896,390C4800,390,4704,390,4608,390C4512,390,4416,390,4320,390C4224,390,4128,390,4032,390C3936,390,3840,390,3744,390,3648,390,3552,390,3456,390,3360,390,3264,390,3168,390,3072,390,2976,390,2880,390,2784,390,2688,390,2592,390,2496,390,2400,390,2304,390,2208,390,2112,390,2016,390,1920,390,1824,390,1728,390,1632,390,1536,390,1440,390,1344,390,1248,390,1152,390,1056,390,960,390,864,390,768,390,672,390,576,390,480,390,384,390,288,390,192,390,96,390,48,390L0,390Z"></path></svg>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center text-white max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white">Batches</h1>
            <p class="text-lg md:text-xl text-blue-100">Explore our comprehensive range of batches and their details.</p>
        </div>
    </div>
</section>

<section class="bg-gray-50 py-16">
    <div class="max-w-6xl mx-auto px-4">
        <div class="mb-8">
            <input type="text" id="courseSearch" placeholder="Search by batch name or course..."
                   class="w-full md:w-1/2 lg:w-1/3 p-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div class="flex flex-wrap justify-center gap-3 mb-8">
            <button class="day-filter-btn px-6 py-3 rounded-full text-white bg-blue-600 hover:bg-blue-700 transition duration-300 whitespace-nowrap" data-day="All">All</button>
            <button class="day-filter-btn px-6 py-3 rounded-full text-blue-800 bg-blue-100 hover:bg-blue-200 transition duration-300 whitespace-nowrap" data-day="Mon">Mon</button>
            <button class="day-filter-btn px-6 py-3 rounded-full text-blue-800 bg-blue-100 hover:bg-blue-200 transition duration-300 whitespace-nowrap" data-day="Tue">Tue</button>
            <button class="day-filter-btn px-6 py-3 rounded-full text-blue-800 bg-blue-100 hover:bg-blue-200 transition duration-300 whitespace-nowrap" data-day="Wed">Wed</button>
            <button class="day-filter-btn px-6 py-3 rounded-full text-blue-800 bg-blue-100 hover:bg-blue-200 transition duration-300 whitespace-nowrap" data-day="Thu">Thu</button>
            <button class="day-filter-btn px-6 py-3 rounded-full text-blue-800 bg-blue-100 hover:bg-blue-200 transition duration-300 whitespace-nowrap" data-day="Fri">Fri</button>
            <button class="day-filter-btn px-6 py-3 rounded-full text-blue-800 bg-blue-100 hover:bg-blue-200 transition duration-300 whitespace-nowrap" data-day="Sat">Sat</button>
            <button class="day-filter-btn px-6 py-3 rounded-full text-blue-800 bg-blue-100 hover:bg-blue-200 transition duration-300 whitespace-nowrap" data-day="Sun">Sun</button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-xl shadow" id="batchesTable">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="py-4 px-4 text-center">Batch Name</th>
                        <th class="py-4 px-4 text-center">Course</th>
                        <th class="py-4 px-4 text-center">Start Date</th>
                        <th class="py-4 px-4 text-center">End Date</th>
                        <th class="py-4 px-4 text-center">Fees</th>
                        <th class="py-4 px-4 text-center">Timetable</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($batches as $batch)
                        <tr class="batch-row border-b hover:bg-purple-50">
                            <td class="py-4 px-4 text-center font-semibold text-gray-800 batch-name">{{ $batch->name }}</td>
                            <td class="py-4 px-4 text-center text-gray-700 batch-course">
                                {{ $batch->course->name ?? '-' }}
                            </td>
                            <td class="py-4 px-4 text-center text-gray-700">{{ \Carbon\Carbon::parse($batch->start_date)->format('d M Y') }}</td>
                            <td class="py-4 px-4 text-center text-gray-700">{{ \Carbon\Carbon::parse($batch->end_date)->format('d M Y') }}</td>
                            <td class="py-4 px-4 text-center text-gray-700">{{ number_format($batch->fees, 2) }}</td>
                            <td class="py-4 px-4 text-center text-gray-700 batch-timetable">
                                <div class="max-w-xs mx-auto truncate" title="{{ $batch->timetable }}">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($batch->timetable), 40) }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr id="noBatchesFoundRow">
                            <td colspan="6" class="py-8 text-center text-gray-500">No batches found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
    // Wave animation on scroll
    const wave = document.getElementById('wave');
    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;
        wave.style.transform = `translate(0, ${scrollY * 0.5}px)`;
    });

    // Batch filtering and searching
    document.addEventListener('DOMContentLoaded', function() {
        const dayFilterButtons = document.querySelectorAll('.day-filter-btn');
        const courseSearchInput = document.getElementById('courseSearch');
        const batchRows = document.querySelectorAll('.batch-row');
        const noBatchesFoundRow = document.getElementById('noBatchesFoundRow');

        let currentSelectedDay = 'All'; // Keep track of the currently selected day
        let currentSearchTerm = ''; // Keep track of the current search term

        function applyFilters() {
            let foundBatches = 0;
            batchRows.forEach(row => {
                const batchName = row.querySelector('.batch-name').textContent.toLowerCase();
                const courseName = row.querySelector('.batch-course').textContent.toLowerCase();
                const timetableText = row.querySelector('.batch-timetable').textContent.toLowerCase();

                const matchesSearch = currentSearchTerm === '' ||
                                      batchName.includes(currentSearchTerm) ||
                                      courseName.includes(currentSearchTerm);

                const matchesDay = currentSelectedDay === 'All' ||
                                   timetableText.includes(currentSelectedDay.toLowerCase());

                if (matchesSearch && matchesDay) {
                    row.style.display = ''; // Show row
                    foundBatches++;
                } else {
                    row.style.display = 'none'; // Hide row
                }
            });

            // Show/hide "No batches found" message
            if (noBatchesFoundRow) {
                if (foundBatches === 0) {
                    noBatchesFoundRow.style.display = '';
                } else {
                    noBatchesFoundRow.style.display = 'none';
                }
            }

            // Update active button styling for days
            dayFilterButtons.forEach(button => {
                if (button.dataset.day === currentSelectedDay) {
                    button.classList.remove('text-blue-800', 'bg-blue-100', 'hover:bg-blue-200');
                    button.classList.add('text-white', 'bg-blue-600', 'hover:bg-blue-700');
                } else {
                    button.classList.remove('text-white', 'bg-blue-600', 'hover:bg-blue-700');
                    button.classList.add('text-blue-800', 'bg-blue-100', 'hover:bg-blue-200');
                }
            });
        }

        // Event listener for day filter buttons
        dayFilterButtons.forEach(button => {
            button.addEventListener('click', () => {
                currentSelectedDay = button.dataset.day;
                applyFilters();
            });
        });

        // Event listener for search input
        courseSearchInput.addEventListener('keyup', function() {
            currentSearchTerm = this.value.toLowerCase().trim();
            applyFilters();
        });

        // Initially apply filters to show all batches
        applyFilters();
    });
</script>

@endsection