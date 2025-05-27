@extends('branding.layouts')

@section('content')

@vite(['resources/css/app.css', 'resources/js/app.js'])

{{-- Jquery is still useful for some DOM manipulations, though not strictly required for this table approach --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<section class="relative py-16 bg-gradient-to-r from-blue-800 to-blue-600">
    <div class="absolute inset-0 overflow-hidden">
        <svg id="wave" style="transform:rotate(180deg); transition: 0.3s" viewBox="0 0 1440 390" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0">
                    <stop stop-color="rgba(0, 11.511, 223.445, 1)" offset="0%"></stop>
                    <stop stop-color="rgba(167.659, 182.451, 225.722, 1)" offset="100%"></stop>
                </linearGradient>
            </defs>
            <path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,117L48,123.5C96,130,192,143,288,169C384,195,480,234,576,227.5C672,221,768,169,864,182C960,195,1056,273,1152,266.5C1248,260,1344,169,1440,117C1536,65,1632,52,1728,52C1824,52,1920,65,2016,58.5C2112,52,2208,26,2304,26C2400,26,2496,52,2592,97.5C2688,143,2784,208,2880,208C2976,208,3072,143,3168,136.5C3264,130,3360,182,3456,208C3552,234,3648,234,3744,221C3840,208,3936,182,4032,156C4128,130,4224,104,4320,97.5C4416,91,4512,104,4608,143C4704,182,4800,247,4896,240.5C4992,234,5088,156,5184,130C5280,104,5376,130,5472,130C5568,130,5664,104,5760,130C5856,156,5952,234,6048,279.5C6144,325,6240,338,6336,286C6432,234,6528,117,6624,97.5C6720,78,6816,156,6864,195L6912,234L6912,390L6864,390C6816,390,6720,390,6624,390C6528,390,6432,390,6336,390C6240,390,6144,390,6048,390C5952,390,5856,390,5760,390C5664,390,5568,390,5472,390C5376,390,5280,390,5184,390C5088,390,4992,390,4896,390C4800,390,4704,390,4608,390C4512,390,4416,390,4320,390C4224,390,4128,390,4032,390C3936,390,3840,390,3744,390,3648,390,3552,390,3456,390,3360,390,3264,390,3168,390,3072,390,2976,390,2880,390,2784,390,2688,390,2592,390,2496,390,2400,390,2304,390,2208,390,2112,390,2016,390,1920,390,1824,390,1728,390,1632,390,1536,390,1440,390,1344,390,1248,390,1152,390,1056,390,960,390,864,390,768,390,672,390,576,390,480,390,384,390,288,390,192,390,96,390,48,390L0,390Z"></path>
        </svg>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center text-white max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white">Our Teachers</h1>
            <p class="text-lg md:text-xl text-blue-100">Explore our comprehensive range of courses designed to enhance your skills and knowledge in various domains of commerce and business.</p>
        </div>
    </div>
</section>

<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">
            Meet Our <span class="text-blue-700">Instructors</span>
        </h2>

        <div class="flex justify-center items-center my-8">
            <div class="relative w-full max-w-2xl">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-blue-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input
                    id="combinedSearch"
                    type="text"
                    class="pl-12 pr-10 py-3 w-full rounded-full border border-blue-300 shadow focus:ring-2 focus:ring-blue-500 text-gray-700"
                    placeholder="Search by course, batch or teacher name..."
                    autocomplete="off"
                />
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-blue-500 cursor-pointer" id="dropdownIcon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </span>
                <div id="dropdownMenu" class="absolute left-0 right-0 top-14 bg-white border border-blue-200 rounded-xl shadow-lg z-20 max-h-60 overflow-auto hidden">
                    <div class="py-2">
                        <div class="px-6 py-2 hover:bg-blue-50 cursor-pointer batch-option" data-value="all">All Batches</div>
                        @foreach($allBatches as $batch)
                            <div class="px-6 py-2 hover:bg-blue-50 cursor-pointer batch-option"
                                data-value="{{ ($batch->course->name ?? 'No Course') . ' - ' . $batch->name }}">
                                {{ ($batch->course->name ?? 'No Course') . ' - ' . $batch->name }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Teacher Table --}}
        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full border-collapse border border-gray-400 divide-y divide-gray-200" id="teachersTable">
                <thead class="bg-blue-700">
                    <tr>
                        <th scope="col" class="border border-gray-300 px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Image
                        </th>
                        <th scope="col" class="border border-gray-300 px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Name
                        </th>
                        <th scope="col" class="border border-gray-300 px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Position
                        </th>
                        <th scope="col" class="border border-gray-300 px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Batches & Courses
                        </th>
                        <th scope="col" class="border border-gray-300 px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Phone
                        </th>
                        <th scope="col" class="border border-gray-300 px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                            Email
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="teachersTableBody">
                    {{-- Teacher rows will be loaded here by JavaScript --}}
                </tbody>
            </table>
        </div>

        {{-- Pagination controls --}}
        <div class="flex items-center justify-between px-4 py-3 sm:px-6 mt-8"> {{-- Removed bg-white, shadow-md, rounded-lg --}}
            {{-- Mobile pagination - now mirroring desktop layout --}}
            <div class="flex flex-1 justify-between sm:hidden">
                <div class="text-sm text-gray-700 w-full text-center mb-4">
                    Showing
                    <span id="fromEntryMobile" class="font-medium">0</span>
                    to
                    <span id="toEntryMobile" class="font-medium">0</span>
                    of
                    <span id="totalEntriesMobile" class="font-medium">0</span>
                    results
                </div>
                <nav class="isolate inline-flex -space-x-px rounded-md" aria-label="Pagination"> {{-- Removed shadow-sm --}}
                    <button id="prevPageMobile" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-white bg-blue-700 ring-1 ring-inset ring-blue-700 hover:bg-gray-800 hover:text-white focus:z-20 focus:outline-offset-0 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span class="sr-only">Previous</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 010 1.06L9.56 10l3.23 3.71a.75.75 0 01-1.06 1.06l-4-4a.75.75 0 010-1.06l4-4a.75.75 0 011.06 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div id="paginationNumbersMobile" class="inline-flex"></div> {{-- Page numbers for mobile --}}
                    <button id="nextPageMobile" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-white bg-blue-700 ring-1 ring-inset ring-blue-700 hover:bg-gray-800 hover:text-white focus:z-20 focus:outline-offset-0 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span class="sr-only">Next</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 010-1.06L10.44 10 7.21 6.29a.75.75 0 011.06-1.06l4 4a.75.75 0 010 1.06l-4 4a.75.75 0 01-1.06 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </nav>
            </div>

            {{-- Desktop pagination --}}
            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Showing
                        <span id="fromEntry" class="font-medium">0</span>
                        to
                        <span id="toEntry" class="font-medium">0</span>
                        of
                        <span id="totalEntries" class="font-medium">0</span>
                        results
                    </p>
                </div>
                <div>
                    <nav class="isolate inline-flex -space-x-px rounded-md" aria-label="Pagination"> {{-- Removed shadow-sm --}}
                        <button id="prevPage" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-white bg-blue-700 ring-1 ring-inset ring-blue-700 hover:bg-gray-800 hover:text-white focus:z-20 focus:outline-offset-0 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span class="sr-only">Previous</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 010 1.06L9.56 10l3.23 3.71a.75.75 0 01-1.06 1.06l-4-4a.75.75 0 010-1.06l4-4a.75.75 0 011.06 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        {{-- Page numbers will be injected here --}}
                        <div id="paginationNumbers" class="inline-flex"></div>
                        <button id="nextPage" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-white bg-blue-700 ring-1 ring-inset ring-blue-700 hover:bg-gray-800 hover:text-white focus:z-20 focus:outline-offset-0 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span class="sr-only">Next</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 010-1.06L10.44 10 7.21 6.29a.75.75 0 011.06-1.06l4 4a.75.75 0 010 1.06l-4 4a.75.75 0 01-1.06 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </nav>
                </div>
            </div>
        </div>

        {{-- This message is for when filters result in no matches --}}
        <p id="noResultsMessage" class="text-center text-gray-600 col-span-full mt-4 hidden">
            No teachers found matching your search.
        </p>
    </div>
</section>

{{-- Image Zoom Modal --}}
<div id="imageModal" class="fixed inset-0 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="relative bg-white p-4 rounded-lg shadow-lg max-w-xl max-h-full overflow-auto">
        <button id="closeModal" class="absolute top-2 right-2 text-gray-800 bg-white rounded-full p-2 hover:bg-gray-100 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <img id="zoomedImage" src="" alt="Zoomed Teacher Image" class="max-w-full max-h-[80vh] object-contain mx-auto">
        <p id="modalTeacherName" class="text-center mt-2 text-lg font-semibold text-gray-800"></p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const wave = document.getElementById('wave');
    const combinedInput = document.getElementById('combinedSearch');
    const dropdownIcon = document.getElementById('dropdownIcon');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const teachersTableBody = document.getElementById('teachersTableBody');
    const noResultsMessage = document.getElementById('noResultsMessage');

    // Pagination elements (Desktop)
    const prevPageBtn = document.getElementById('prevPage');
    const nextPageBtn = document.getElementById('nextPage');
    const paginationNumbersContainer = document.getElementById('paginationNumbers');
    const fromEntrySpan = document.getElementById('fromEntry');
    const toEntrySpan = document.getElementById('toEntry');
    const totalEntriesSpan = document.getElementById('totalEntries');

    // Pagination elements (Mobile)
    const prevPageMobileBtn = document.getElementById('prevPageMobile');
    const nextPageMobileBtn = document.getElementById('nextPageMobile');
    const paginationNumbersMobileContainer = document.getElementById('paginationNumbersMobile');
    const fromEntryMobileSpan = document.getElementById('fromEntryMobile');
    const toEntryMobileSpan = document.getElementById('toEntryMobile');
    const totalEntriesMobileSpan = document.getElementById('totalEntriesMobile');

    // Modal elements
    const imageModal = document.getElementById('imageModal');
    const zoomedImage = document.getElementById('zoomedImage');
    const modalTeacherName = document.getElementById('modalTeacherName');
    const closeModalBtn = document.getElementById('closeModal');

    let currentPage = 1;
    const teachersPerPage = 4; // Number of teachers to display per page
    let totalPages = 1;
    let totalTeachers = 0; // To store the total number of teachers for pagination info

    let currentSearchValue = '';
    let currentBatchFilter = 'all';

    // Parallax effect for wave
    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;
        wave.style.transform = `translate(0, ${scrollY * 0.5}px) rotate(180deg)`;
    });

    /**
     * Renders pagination numbers and updates "Showing X to Y of Z results" text for both desktop and mobile.
     */
    function renderPagination() {
        paginationNumbersContainer.innerHTML = ''; // Clear existing numbers (Desktop)
        paginationNumbersMobileContainer.innerHTML = ''; // Clear existing numbers (Mobile)

        const maxPagesToShow = 5; // Adjust as needed
        let startPage = Math.max(1, currentPage - Math.floor(maxPagesToShow / 2));
        let endPage = Math.min(totalPages, startPage + maxPagesToShow - 1);

        if (endPage - startPage + 1 < maxPagesToShow) {
            startPage = Math.max(1, endPage - maxPagesToShow + 1);
        }

        // Helper function to create page number button
        const createPageButton = (pageNumber, isActive) => {
            const pageBtn = document.createElement('button');
            pageBtn.classList.add(
                'relative', 'inline-flex', 'items-center', 'px-4', 'py-2', 'text-sm', 'font-semibold',
                'ring-1', 'ring-inset', 'ring-blue-700', 'hover:bg-gray-800', 'hover:text-white',
                'focus:z-20', 'focus:outline-offset-0', 'text-white', 'bg-blue-700' // Base styles
            );
            if (isActive) {
                pageBtn.classList.remove('bg-blue-700', 'hover:bg-gray-800');
                pageBtn.classList.add('z-10', 'bg-gray-800'); // Active state: black background
            } else {
                pageBtn.addEventListener('click', () => {
                    currentPage = pageNumber;
                    fetchTeachers();
                });
            }
            pageBtn.textContent = pageNumber;
            return pageBtn;
        };

        // Render for Desktop
        // Add ellipsis if needed at the start
        if (startPage > 1) {
            const ellipsisSpan = document.createElement('span');
            ellipsisSpan.classList.add('relative', 'inline-flex', 'items-center', 'px-4', 'py-2', 'text-sm', 'font-semibold', 'text-white', 'bg-blue-700', 'ring-1', 'ring-inset', 'ring-blue-700', 'focus:outline-offset-0');
            ellipsisSpan.textContent = '...';
            paginationNumbersContainer.appendChild(ellipsisSpan);
        }

        for (let i = startPage; i <= endPage; i++) {
            paginationNumbersContainer.appendChild(createPageButton(i, i === currentPage));
        }

        // Add ellipsis if needed at the end
        if (endPage < totalPages) {
            const ellipsisSpan = document.createElement('span');
            ellipsisSpan.classList.add('relative', 'inline-flex', 'items-center', 'px-4', 'py-2', 'text-sm', 'font-semibold', 'text-white', 'bg-blue-700', 'ring-1', 'ring-inset', 'ring-blue-700', 'focus:outline-offset-0');
            ellipsisSpan.textContent = '...';
            paginationNumbersContainer.appendChild(ellipsisSpan);
        }

        // Render for Mobile (mirroring desktop logic)
        if (startPage > 1) {
            const ellipsisSpan = document.createElement('span');
            ellipsisSpan.classList.add('relative', 'inline-flex', 'items-center', 'px-4', 'py-2', 'text-sm', 'font-semibold', 'text-white', 'bg-blue-700', 'ring-1', 'ring-inset', 'ring-blue-700', 'focus:outline-offset-0');
            ellipsisSpan.textContent = '...';
            paginationNumbersMobileContainer.appendChild(ellipsisSpan);
        }

        for (let i = startPage; i <= endPage; i++) {
            paginationNumbersMobileContainer.appendChild(createPageButton(i, i === currentPage));
        }

        if (endPage < totalPages) {
            const ellipsisSpan = document.createElement('span');
            ellipsisSpan.classList.add('relative', 'inline-flex', 'items-center', 'px-4', 'py-2', 'text-sm', 'font-semibold', 'text-white', 'bg-blue-700', 'ring-1', 'ring-inset', 'ring-blue-700', 'focus:outline-offset-0');
            ellipsisSpan.textContent = '...';
            paginationNumbersMobileContainer.appendChild(ellipsisSpan);
        }


        // Update "Showing X to Y of Z results" for Desktop
        const fromEntry = (currentPage - 1) * teachersPerPage + 1;
        const toEntry = Math.min(currentPage * teachersPerPage, totalTeachers);
        fromEntrySpan.textContent = totalTeachers === 0 ? 0 : fromEntry;
        toEntrySpan.textContent = toEntry;
        totalEntriesSpan.textContent = totalTeachers;

        // Update "Showing X to Y of Z results" for Mobile
        fromEntryMobileSpan.textContent = totalTeachers === 0 ? 0 : fromEntry;
        toEntryMobileSpan.textContent = toEntry;
        totalEntriesMobileSpan.textContent = totalTeachers;

        // Update previous/next buttons for Desktop
        prevPageBtn.disabled = (currentPage <= 1);
        nextPageBtn.disabled = (currentPage >= totalPages);

        // Update previous/next buttons for Mobile
        prevPageMobileBtn.disabled = (currentPage <= 1);
        nextPageMobileBtn.disabled = (currentPage >= totalPages);
    }

    /**
     * Fetches teachers data from the server via AJAX and updates the table.
     */
    function fetchTeachers() {
        console.log('Fetching teachers for page:', currentPage, 'search:', currentSearchValue, 'batch_filter:', currentBatchFilter);

        teachersTableBody.innerHTML = `<tr><td colspan="6" class="text-center py-4 text-gray-500">Loading teachers...</td></tr>`;
        noResultsMessage.classList.add('hidden');

        $.ajax({
            url: "{{ route('get.teachers.ajax') }}",
            method: 'GET',
            data: {
                page: currentPage,
                search: currentSearchValue,
                batch_filter: currentBatchFilter,
                teachers_per_page: teachersPerPage
            },
            success: function(response) {
                console.log('AJAX response:', response);
                teachersTableBody.innerHTML = '';
                let resultsFound = false;

                if (response.data && response.data.length > 0) {
                    response.data.forEach(teacher => {
                        const row = document.createElement('tr');
                        row.classList.add('teacher-row');
                        row.dataset.name = teacher.name || '';
                        row.dataset.batches = teacher.batches_data || '';

                        // Fallback for profile image
                        const profileImageUrl = teacher.profile_image ? teacher.profile_image : `{{ asset('images/default-profile.png') }}`;

                        row.innerHTML = `
                            <td class="border border-gray-300 px-6 py-4 whitespace-nowrap">
                                <div class="flex-shrink-0 w-12 h-12 rounded-full overflow-hidden border border-gray-200 cursor-pointer image-thumbnail">
                                    <img class="object-cover w-full h-full" src="${profileImageUrl}" alt="${teacher.name}" data-full-image="${profileImageUrl}" data-teacher-name="${teacher.name}">
                                </div>
                            </td>
                            <td class="border border-gray-300 px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                ${teacher.name}
                            </td>
                            <td class="border border-gray-300 px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                ${teacher.position || 'N/A'}
                            </td>
                            <td class="border border-gray-300 px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                ${teacher.batches_data.split(';').map(batch => `<div>${batch}</div>`).join('') || 'No Batches'}
                            </td>
                            <td class="border border-gray-300 px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                ${teacher.phone || 'N/A'}
                            </td>
                            <td class="border border-gray-300 px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                ${teacher.email || 'N/A'}
                            </td>
                        `;
                        teachersTableBody.appendChild(row);
                        resultsFound = true;
                    });
                }

                // Update pagination controls
                totalTeachers = response.total;
                totalPages = response.last_page;
                currentPage = response.current_page; // Ensure currentPage is in sync with server response
                renderPagination(); // Re-render page numbers and info

                // Show/hide no results message
                if (!resultsFound) {
                    teachersTableBody.innerHTML = `<tr><td colspan="6" class="border border-gray-300 px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">No teachers found matching your criteria.</td></tr>`;
                    noResultsMessage.classList.remove('hidden');
                } else {
                    noResultsMessage.classList.add('hidden');
                }

                // Add event listeners to the new image thumbnails
                document.querySelectorAll('.image-thumbnail img').forEach(img => {
                    img.addEventListener('click', (e) => {
                        const fullImageUrl = e.target.getAttribute('data-full-image');
                        const teacherName = e.target.getAttribute('data-teacher-name');
                        zoomedImage.src = fullImageUrl;
                        modalTeacherName.textContent = teacherName;
                        imageModal.classList.remove('hidden');
                        document.body.style.overflow = 'hidden'; // Prevent scrolling
                    });
                });
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error, xhr.responseText);
                teachersTableBody.innerHTML = `<tr><td colspan="6" class="border border-gray-300 px-6 py-4 whitespace-nowrap text-center text-sm text-red-500">Error loading teachers. Please try again.</td></tr>`;
                noResultsMessage.classList.remove('hidden');
            }
        });
    }

    // Pagination Event Listeners (Desktop)
    prevPageBtn.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            fetchTeachers();
        }
    });

    nextPageBtn.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            fetchTeachers();
        }
    });

    // Mobile Pagination Event Listeners (now identical to desktop)
    prevPageMobileBtn.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            fetchTeachers();
        }
    });

    nextPageMobileBtn.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            fetchTeachers();
        }
    });


    let debounceTimer;
    combinedInput.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            const newSearchValue = combinedInput.value.trim().toLowerCase();
            if (newSearchValue !== currentSearchValue) {
                currentSearchValue = newSearchValue;
                currentBatchFilter = 'all'; // Clear batch filter when typing in search
                currentPage = 1; // Reset to first page on new search

                document.querySelectorAll('.batch-option').forEach(option => {
                    option.classList.remove('selected');
                });
                document.querySelector('.batch-option[data-value="all"]').classList.add('selected');

                fetchTeachers();
            }
        }, 300);
    });

    dropdownIcon.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdownMenu.classList.toggle('hidden');
    });

    document.querySelectorAll('.batch-option').forEach(option => {
        option.addEventListener('click', function() {
            const newBatchFilter = this.getAttribute('data-value').toLowerCase();
            const displayValue = this.getAttribute('data-value');

            combinedInput.value = (newBatchFilter === 'all') ? '' : displayValue;
            currentSearchValue = ''; // Clear search input when a batch filter is applied

            document.querySelectorAll('.batch-option').forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');

            if (newBatchFilter !== currentBatchFilter) {
                currentBatchFilter = newBatchFilter;
                currentPage = 1; // Reset to first page on new batch filter
                dropdownMenu.classList.add('hidden');
                fetchTeachers();
            } else {
                dropdownMenu.classList.add('hidden');
            }
        });
    });

    // Close dropdown if clicked outside
    document.addEventListener('click', (e) => {
        if (!combinedInput.contains(e.target) && !dropdownIcon.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });

    // Close modal when close button is clicked
    closeModalBtn.addEventListener('click', () => {
        imageModal.classList.add('hidden');
        document.body.style.overflow = ''; // Restore scrolling
    });

    // Close modal when clicking outside the image (on the overlay)
    imageModal.addEventListener('click', (e) => {
        if (e.target === imageModal) {
            imageModal.classList.add('hidden');
            document.body.style.overflow = ''; // Restore scrolling
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !imageModal.classList.contains('hidden')) {
            imageModal.classList.add('hidden');
            document.body.style.overflow = '';
        }
    });

    // Initial load of teachers when the page loads
    fetchTeachers();
});
</script>

<style>
    input:focus {
        border-color: #2563eb; /* Tailwind blue-600 */
        box-shadow: 0 0 0 1px #2563eb; /* Tailwind blue-600 */
        outline: none; /* Remove default outline */
    }
    #dropdownMenu {
        min-width: 200px;
        max-width: 100%;
    }
    /* Add a class for selected dropdown option */
    .batch-option.selected {
        background-color: #e0f2fe; /* light blue */
        font-weight: 600;
        color: #2563eb; /* Blue-700 equivalent */
    }
    /* Styles for the pagination buttons */
    .pagination-button {
        color: white; /* All text colors white */
        background-color: #1d4ed8; /* Blue-700 */
        border-color: #1d4ed8; /* Blue-700 */
    }
    .pagination-button:hover {
        background-color: #1f2937; /* Gray-800 or Black */
        color: white;
    }
    .pagination-button:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    .pagination-button.active {
        background-color: #1f2937; /* Black or Gray-800 for active */
        color: white;
    }
</style>
@endsection