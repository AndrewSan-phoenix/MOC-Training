@extends('branding.layouts')

@section('content')

@vite(['resources/css/app.css', 'resources/js/app.js'])


<section class="relative py-12 bg-gradient-to-r from-blue-800 to-blue-600">
    <div class="absolute inset-0 overflow-hidden">
        </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center text-white max-w-3xl mx-auto">
            <h1 class="text-3xl md:text-4xl font-bold mb-3 text-white">Batches Overview</h1>
            <p class="text-base md:text-lg text-blue-100">Explore our comprehensive range of batches and their details.</p>
        </div>
    </div>
</section>

<section class="bg-gray-50 py-12">
    <div class="max-w-6xl mx-auto px-4">
        <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <input type="text" id="courseSearch" placeholder="Search by batch or course name..."
                class="w-full md:w-1/2 lg:w-1/3 p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
            <select id="statusFilter" class="w-full md:w-48 p-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                <option value="all">All Status</option>
                <option value="active">Active</option>
                <option value="done">Done</option>
                <option value="coming">Coming</option>
            </select>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow" id="batchesTable">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="py-3 px-3 text-center text-sm font-semibold">Batch</th>
                        <th class="py-3 px-3 text-center text-sm font-semibold">Course</th>
                        <th class="py-3 px-3 text-center text-sm font-semibold">Start Date</th>
                        <th class="py-3 px-3 text-center text-sm font-semibold">End Date</th>
                        <th class="py-3 px-3 text-center text-sm font-semibold">Fund</th>
                        <th class="py-3 px-3 text-center text-sm font-semibold">Timetable</th>
                        <th class="py-3 px-3 text-center text-sm font-semibold">Status</th>
                        <th class="py-3 px-3 text-center text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $today = \Carbon\Carbon::today();
                    @endphp
                    @forelse($batches as $batch)
                        @php
                            $start = \Carbon\Carbon::parse($batch->start_date);
                            $end = \Carbon\Carbon::parse($batch->end_date);
                            if ($today->between($start, $end)) {
                                $status = 'active';
                            } elseif ($today->lt($start)) {
                                $status = 'coming';
                            } else {
                                $status = 'done';
                            }
                        @endphp
                        <tr class="batch-row border-b hover:bg-blue-50" data-status="{{ $status }}">
                            <td class="py-3 px-3 text-center font-medium text-gray-800 text-sm batch-name">{{ $batch->name }}</td>
                            <td class="py-3 px-3 text-center text-gray-700 text-sm batch-course">
                                {{ $batch->course->name ?? '-' }}
                            </td>
                            <td class="py-3 px-3 text-center text-gray-700 text-sm">{{ $start->format('d M Y') }}</td>
                            <td class="py-3 px-3 text-center text-gray-700 text-sm">{{ $end->format('d M Y') }}</td>
                            <td class="py-3 px-3 text-center text-gray-700 text-sm">{{ number_format($batch->fees, 2) }}</td>
                            <td class="py-3 px-3 text-center text-gray-700 text-sm batch-timetable">
                                <div class="max-w-xs mx-auto truncate" title="{{ strip_tags($batch->timetable) }}">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($batch->timetable), 40) }}
                                </div>
                            </td>
                            <td class="py-3 px-3 text-center text-sm">
                                <span class="inline-block px-3 py-1 rounded-full
                                    @if($status=='active') bg-green-100 text-green-700
                                    @elseif($status=='done') bg-gray-200 text-gray-700
                                    @else bg-yellow-100 text-yellow-700 @endif
                                " style="min-width: 60px; text-transform: capitalize;">
                                    {{ $status }}
                                </span>
                            </td>

                           

                            <td class="py-3 px-3 text-center">
                                <button class="toggle-details-btn p-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-150">
                                    {{-- Down arrow icon (initially visible) --}}
                                    <svg class="down-arrow w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 5.25 7.5 7.5 7.5-7.5m-15 6 7.5 7.5 7.5-7.5" />
</svg>
                                    {{-- Up arrow icon (initially hidden) --}}
                                    <svg class="up-arrow w-5 h-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 18.75 7.5-7.5 7.5 7.5" />
  <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 7.5-7.5 7.5 7.5" />
</svg>
                                </button>
                            </td>
                        </tr>
                        <tr class="batch-details-content" style="display: none;">
                            <td colspan="8" class="bg-blue-50 px-4 py-3">
                                @if($batch->batchDetails->count())
                                    <div class="overflow-x-auto">
                                        <h4 class="text-md font-semibold text-blue-700 mb-2">Batch Schedule: {{ $batch->name }}</h4>
                                        <table class="min-w-full bg-white rounded shadow-sm">
                                            <thead>
                                                <tr class="bg-blue-100 text-blue-800">
                                                    <th class="py-2 px-3 text-left text-sm">Teacher</th>
                                                    <th class="py-2 px-3 text-left text-sm">Lecture Title</th>
                                                    <th class="py-2 px-3 text-left text-sm">Lecture Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($batch->batchDetails as $detail)
                                                    <tr class="border-t border-blue-200">
                                                        <td class="py-2 px-3 text-sm">{{ $detail->teacher->name ?? '-' }}</td>
                                                        <td class="py-2 px-3 text-sm">{{ $detail->lecture_title ?? '-' }}</td>
                                                        <td class="py-2 px-3 text-sm">{{ $detail->lecture_date ? \Carbon\Carbon::parse($detail->lecture_date)->format('d M Y') : '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-gray-500 text-sm p-3 text-center">No specific schedule details found for this batch.</div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr id="noBatchesFoundRow">
                            <td colspan="8" class="py-6 text-center text-gray-500 text-sm">No batches found.</td>
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
    if (wave) {
        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;
            wave.style.transform = `translate(0, ${scrollY * 0.5}px) rotate(180deg)`;
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const courseSearchInput = document.getElementById('courseSearch');
        const statusFilter = document.getElementById('statusFilter');
        const batchRows = document.querySelectorAll('.batch-row');
        const noBatchesFoundRow = document.getElementById('noBatchesFoundRow');

        let currentSearchTerm = '';
        let currentStatus = 'all';

        function applyFilters() {
            let foundBatches = 0;
            batchRows.forEach(row => {
                const batchName = row.querySelector('.batch-name').textContent.toLowerCase();
                const courseNameElement = row.querySelector('.batch-course');
                const courseName = courseNameElement ? courseNameElement.textContent.toLowerCase() : '';
                const status = row.getAttribute('data-status');

                const matchesSearch = currentSearchTerm === '' ||
                                      batchName.includes(currentSearchTerm) ||
                                      courseName.includes(currentSearchTerm);
                
                const matchesStatus = currentStatus === 'all' || status === currentStatus;

                const detailsRow = row.nextElementSibling;
                const downArrow = row.querySelector('.toggle-details-btn .down-arrow');
                const upArrow = row.querySelector('.toggle-details-btn .up-arrow');

                if (matchesSearch && matchesStatus) {
                    row.style.display = '';
                    foundBatches++;
                } else {
                    row.style.display = 'none';
                    // If a batch row is hidden, ensure its details are hidden and arrow is down
                    if (detailsRow && detailsRow.classList.contains('batch-details-content')) {
                        detailsRow.style.display = 'none';
                        if (downArrow) downArrow.classList.remove('hidden');
                        if (upArrow) upArrow.classList.add('hidden');
                    }
                }
            });

            if (noBatchesFoundRow) {
                noBatchesFoundRow.style.display = foundBatches === 0 ? '' : 'none';
            }
        }

        if (courseSearchInput) {
            courseSearchInput.addEventListener('keyup', function() {
                currentSearchTerm = this.value.toLowerCase().trim();
                applyFilters();
            });
        }

        if (statusFilter) {
            statusFilter.addEventListener('change', function() {
                currentStatus = this.value;
                applyFilters();
            });
        }

        // Event listener for toggle buttons
        document.querySelectorAll('.toggle-details-btn').forEach(button => {
            button.addEventListener('click', function() {
                const mainRow = this.closest('.batch-row');
                const detailsRow = mainRow.nextElementSibling;
                const downArrow = this.querySelector('.down-arrow');
                const upArrow = this.querySelector('.up-arrow');

                if (detailsRow && detailsRow.classList.contains('batch-details-content')) {
                    if (detailsRow.style.display === 'none') {
                        detailsRow.style.display = 'table-row';
                        if (downArrow) downArrow.classList.add('hidden');
                        if (upArrow) upArrow.classList.remove('hidden');
                    } else {
                        detailsRow.style.display = 'none';
                        if (downArrow) downArrow.classList.remove('hidden');
                        if (upArrow) upArrow.classList.add('hidden');
                    }
                }
            });
        });

        // Initial filter application
        applyFilters();
    });
</script>

@endsection