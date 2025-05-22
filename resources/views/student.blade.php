@extends('branding.layouts') 

@section('content')

@vite(['resources/css/app.css', 'resources/js/app.js'])
<link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Inter:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<!-- Page Header -->
<section class="relative py-16 bg-gradient-to-r from-blue-800 to-blue-600">
    <div class="absolute inset-0 overflow-hidden">
        <svg id="wave" style="transform:rotate(180deg); transition: 0.3s" viewBox="0 0 1440 390" version="1.1" xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(0, 11.511, 223.445, 1)" offset="0%"></stop><stop stop-color="rgba(167.659, 182.451, 225.722, 1)" offset="100%"></stop></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,117L48,123.5C96,130,192,143,288,169C384,195,480,234,576,227.5C672,221,768,169,864,182C960,195,1056,273,1152,266.5C1248,260,1344,169,1440,117C1536,65,1632,52,1728,52C1824,52,1920,65,2016,58.5C2112,52,2208,26,2304,26C2400,26,2496,52,2592,97.5C2688,143,2784,208,2880,208C2976,208,3072,143,3168,136.5C3264,130,3360,182,3456,208C3552,234,3648,234,3744,221C3840,208,3936,182,4032,156C4128,130,4224,104,4320,97.5C4416,91,4512,104,4608,143C4704,182,4800,247,4896,240.5C4992,234,5088,156,5184,130C5280,104,5376,130,5472,130C5568,130,5664,104,5760,130C5856,156,5952,234,6048,279.5C6144,325,6240,338,6336,286C6432,234,6528,117,6624,97.5C6720,78,6816,156,6864,195L6912,234L6912,390L6864,390C6816,390,6720,390,6624,390C6528,390,6432,390,6336,390C6240,390,6144,390,6048,390C5952,390,5856,390,5760,390C5664,390,5568,390,5472,390C5376,390,5280,390,5184,390C5088,390,4992,390,4896,390C4800,390,4704,390,4608,390C4512,390,4416,390,4320,390C4224,390,4128,390,4032,390C3936,390,3840,390,3744,390,3648,390,3552,390,3456,390,3360,390,3264,390,3168,390,3072,390,2976,390,2880,390,2784,390,2688,390,2592,390,2496,390,2400,390,2304,390,2208,390,2112,390,2016,390,1920,390,1824,390,1728,390,1632,390,1536,390,1440,390,1344,390,1248,390,1152,390,1056,390,960,390,864,390,768,390,672,390,576,390,480,390,384,390,288,390,192,390,96,390,48,390L0,390Z"></path></svg>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center text-white max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white">Our Students</h1>
            <p class="text-lg md:text-xl text-blue-100">Explore our comprehensive range of courses designed to enhance your skills and knowledge in various domains of commerce and business.</p>
        </div>
    </div>
</section>


<!-- Students Swiper Section -->
<section class="bg-gray-50 py-16" style="margin-top:-0px;">
    <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">
            Meet Our <span class="text-purple-600 script-font">Students</span>
        </h2>

        <!-- Combined Search & Dropdown in One Field -->
        <div class="flex justify-center items-center my-8">
            <div class="relative w-full max-w-2xl">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-purple-500 cursor-pointer" id="searchIcon">
                    <!-- Search Icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input
                    id="combinedSearch"
                    type="text"
                    class="pl-12 pr-10 py-3 w-full rounded-full border border-purple-300 shadow focus:ring-2 focus:ring-purple-500 text-gray-700"
                    placeholder="Search by batch or student name..."
                    autocomplete="off"
                />
                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-purple-500 cursor-pointer" id="dropdownIcon">
                    <!-- Down Arrow Icon -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </span>
                <!-- Dropdown menu, hidden by default -->
                <div id="dropdownMenu" class="absolute left-0 right-0 top-14 bg-white border border-purple-200 rounded-xl shadow-lg z-20 max-h-60 overflow-auto hidden">
                    <div class="py-2">
                        <div class="px-6 py-2 hover:bg-purple-50 cursor-pointer batch-option" data-value="all">All</div>
                        @foreach($allBatches as $batch)
                            <div class="px-6 py-2 hover:bg-purple-50 cursor-pointer batch-option" data-value="{{ $batch->name }}">{{ $batch->name }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Studnets Swiper -->
        <div class="relative">
            <div class="swiper studentSwiper pb-12">
                <div class="swiper-wrapper" id="students-list">
                    @foreach($students as $student)
                        <div class="swiper-slide">
                            <div class="student-card bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all text-center"
                                data-batches="@foreach($student->enrollments as $enrollment){{ $enrollment->batch->name }};@endforeach">
                                <div class="w-28 h-28 mx-auto rounded-full overflow-hidden border-4 border-purple-400 shadow mb-4">
                                    <img src="{{ $student->profile_image ? asset('storage/' . $student->profile_image) : asset('images/default-profile.png') }}"
                                        class="object-cover w-full h-full" alt="{{ $student->name }}">
                                </div>
                                 <h3 class="text-xl font-bold text-gray-800 mb-1">{{ $student->name }}</h3>
                            <p class="text-gray-600 text-sm mb-1">DOB: {{ $student->dob }}</p>
                            <p class="text-gray-600 text-sm mb-1">Phone: {{ $student->phone }}</p>
                            <p class="text-gray-600 text-sm mb-1">Email: {{ $student->email }}</p>
                                <div class="flex justify-center gap-8 mt-4">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Swiper navigation -->
                <div class="swiper-button-prev student-swiper-prev bg-white/80 hover:bg-purple-200 text-purple-700 rounded-full shadow-lg"></div>
                <div class="swiper-button-next student-swiper-next bg-white/80 hover:bg-purple-200 text-purple-700 rounded-full shadow-lg"></div>
            </div>
        </div>
    </div>
</section>



<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Swiper for Students
    const studentSwiper = new Swiper('.studentSwiper', {
        slidesPerView: 1,
        spaceBetween: 32,
        loop: true,
        centeredSlides: true,
        navigation: {
            nextEl: '.student-swiper-next',
            prevEl: '.student-swiper-prev',
        },
        breakpoints: {
            640: { slidesPerView: 1.2 },
            900: { slidesPerView: 2 },
            1200: { slidesPerView: 3 },
        }
    });

    // Count-up animation
    document.querySelectorAll('.count-up').forEach(el => {
        const target = +el.getAttribute('data-count');
        let count = 0;
        const increment = Math.ceil(target / 50);
        function update() {
            count += increment;
            if (count >= target) {
                el.textContent = target;
            } else {
                el.textContent = count;
                requestAnimationFrame(update);
            }
        }
        update();
    });

    // Search & dropdown filter
    const combinedInput = document.getElementById('combinedSearch');
    const dropdownIcon = document.getElementById('dropdownIcon');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const searchIcon = document.getElementById('searchIcon');
    const studentSlides = document.querySelectorAll('.studentSwiper .swiper-slide');

    function filterStudentsBySearch() {
        const value = combinedInput.value.trim().toLowerCase();
        let anyVisible = false;
        studentSlides.forEach(slide => {
            const card = slide.querySelector('.student-card');
            const batches = (card.getAttribute('data-batches') || '').split(';').map(s => s.trim().toLowerCase()).filter(Boolean);
            const name = card.querySelector('h3')?.textContent?.toLowerCase() || '';
            const match = !value || value === 'all' ||
                batches.some(b => b.includes(value)) ||
                name.includes(value);
            slide.style.display = match ? '' : 'none';
            if (match) anyVisible = true;
        });
        studentSwiper.update();
    }

    combinedInput.addEventListener('input', filterStudentsBySearch);
    searchIcon.addEventListener('click', filterStudentsBySearch);

    dropdownIcon.addEventListener('click', function(e) {
        e.stopPropagation();
        dropdownMenu.classList.toggle('hidden');
    });

    document.querySelectorAll('.batch-option').forEach(option => {
        option.addEventListener('click', function() {
            combinedInput.value = this.getAttribute('data-value');
            dropdownMenu.classList.add('hidden');
            filterStudentsBySearch();
        });
    });

    document.addEventListener('click', function(e) {
        if (!dropdownMenu.contains(e.target) && !dropdownIcon.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
});
</script>

<style>
    .script-font {
        font-family: 'Pacifico', cursive;
    }

    .student-card {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .student-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    input:focus {
        border-color: #6b46c1;
        box-shadow: 0 0 0 1px #6b46c1;
    }
    #dropdownMenu {
        min-width: 200px;
        max-width: 100%;
    }
    .swiper-button-next, .swiper-button-prev {
        width: 48px;
        height: 48px;
        color: #7c3aed;
        background: #fff;
        border-radius: 50%;
        box-shadow: 0 4px 16px rgba(109,40,217,0.08);
        top: 50%;
        transform: translateY(-50%);
        transition: background 0.2s, color 0.2s;
    }
    .swiper-button-next:hover, .swiper-button-prev:hover {
        background: #a78bfa;
        color: #fff;
    }
    .swiper-button-next:after, .swiper-button-prev:after {
        font-size: 24px;
        font-weight: bold;
    }
</style>

<script>
    // Wave animation on scroll
    const wave = document.getElementById('wave');
    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;
        wave.style.transform = `translate(0, ${scrollY * 0.5}px)`;
    });
</script>

@endsection