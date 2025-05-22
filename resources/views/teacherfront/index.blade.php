<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MOC Training</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    </head>

<body class="font-sans bg-gray-100">

<header class="bg-blue-50 text-black">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="/" class="flex items-center space-x-2">
            <img src="{{ asset('images/logo.png') }}" alt="MOC Logo" class="h-15 z-10 relative">
        </a>
        <button id="menu-toggle" class="sm:hidden text-white bg-blue-700 p-2 rounded-md">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex space-x-6 text-sm font-medium">
            <a href="{{ route('studentfront') }}" class="text-black hover:text-blue-500">Students</a>
            <a href="#" class="text-black hover:text-blue-500">Teachers</a>
            <a href="#" class="text-black hover:text-blue-500">Batches</a>
            <a href="#" class="text-black hover:text-blue-500">Courses</a>
            <a href="#" class="text-black hover:text-blue-500">Enrolls</a>
            <a href="#" class="text-black hover:text-blue-500">Galleries</a>
        </nav>
    </div>

    <!-- Mobile Navigation -->
    <div id="mobile-menu" class="md:hidden hidden px-4 pb-4 space-y-2">
        <a href="{{ route('studentfront') }}" class="text-black hover:text-blue-500">Students</a>
        <a href="#" class="text-black hover:text-blue-500">Teachers</a>
        <a href="#" class="text-black hover:text-blue-500">Batches</a>
        <a href="#" class="text-black hover:text-blue-500">Courses</a>
        <a href="#" class="text-black hover:text-blue-500">Enrolls</a>
 
        <a href="#" class="text-black hover:text-blue-500">Galleries</a>
    </div>
</header>

<section class="relative h-96 overflow-hidden flex items-center justify-center bg-gray-700">
    <img src="{{ asset('images/officeone.jfif') }}" alt="Office" class="absolute inset-0 w-full h-full object-cover filter blur-sm">
    <div class="absolute inset-0 bg-black opacity-40"></div>
    <div class="relative z-10 text-center px-4 text-white">
        <h1 class="text-3xl md:text-6xl font-bold text-white">Welcome to the Ministry of Commerce</h1>
        <p class="mt-4 text-lg md:text-xl max-w-2xl mx-auto">Empowering businesses and fostering growth in Myanmar</p>
        <a href="{{ route('login') }}" class="mt-6 inline-block px-8 py-3 bg-blue-500 hover:bg-white text-white hover:text-blue-500 rounded-md text-lg font-semibold transition">Login</a>
        <a href="{{ route('register') }}" class="mt-6 inline-block px-8 py-3 bg-blue-500 hover:bg-white text-white hover:text-blue-500 rounded-md text-lg font-semibold transition">Register</a>
    </div>
</section>

<!-- Service Start -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Missions -->
            <div class="text-center p-6 bg-white shadow-xl rounded-xl transition-all duration-300 hover:shadow-2xl">
                <div class="mb-6">
                    <i class="fas fa-graduation-cap text-6xl text-blue-500 mb-4"></i>
                    <h5 class="text-2xl font-semibold text-gray-800 mb-3">Missions</h5>
                    <p class="text-gray-600">To help the students of Myanmar reach their maximum potential by developing innovative ways to challenge them for the future ahead.</p>
                </div>
            </div>
            <!-- Visions -->
            <div class="text-center p-6 bg-white shadow-xl rounded-xl transition-all duration-300 hover:shadow-2xl">
                <div class="mb-6">
                    <i class="fas fa-globe text-6xl text-blue-500 mb-4"></i>
                    <h5 class="text-2xl font-semibold text-gray-800 mb-3">Visions</h5>
                    <p class="text-gray-600">To offer a vibrant learning community that strives for academic success by providing an engaging learning environment.</p>
                </div>
            </div>
            <!-- Focus -->
            <div class="text-center p-6 bg-white shadow-xl rounded-xl transition-all duration-300 hover:shadow-2xl">
                <div class="mb-6">
                    <i class="fas fa-home text-6xl text-blue-500 mb-4"></i>
                    <h5 class="text-2xl font-semibold text-gray-800 mb-3">Focus</h5>
                    <p class="text-gray-600">We focus on utilizing private resources and an international curriculum to prepare students for global opportunities.</p>
                </div>
            </div>
            <!-- Goals -->
            <div class="text-center p-6 bg-white shadow-xl rounded-xl transition-all duration-300 hover:shadow-2xl">
                <div class="mb-6">
                    <i class="fas fa-book-open text-6xl text-blue-500 mb-4"></i>
                    <h5 class="text-2xl font-semibold text-gray-800 mb-3">Goals</h5>
                    <p class="text-gray-600">Our goal is to guide students through our curriculum to help them grow with unlimited potential.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->

<!-- About Thamardi Meiktila -->
<div class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <h6 class="text-primary text-lg font-semibold">About Us</h6>
            <h1 class="text-3xl font-bold text-gray-800"> History and Background</h1>
        </div>
        <div class="flex flex-col lg:flex-row gap-10 items-center">
            <div class="lg:w-1/2">
                <div class="relative w-full h-full">
                    <img class="w-full h-full object-cover rounded-xl shadow-lg" src="{{ asset('images/officetwo.jfif') }}" alt="Thamardi Meiktila">
                </div>
            </div>
            <div class="lg:w-1/2">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Ministry of Commerence</h2>
                <ul class="space-y-2 text-gray-600">
                    <li><i class="fas fa-arrow-right text-blue-500 mr-2"></i>Founded in November 1995 as a boarding school.</li>
                    <li><i class="fas fa-arrow-right text-blue-500 mr-2"></i>Over 25 years of experience in private education and boarding services.</li>
                    <li><i class="fas fa-arrow-right text-blue-500 mr-2"></i>Encouraged by Dr. Win Hlaing to establish the school in Meiktila by founder Daw Kyi Kyi Myint, M.Ed.</li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col lg:flex-row gap-10 items-center">
            <div class="lg:w-1/2">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Ministry of Commerence</h2>
                <p class="text-gray-600"><i class="fas fa-arrow-right text-blue-500 mr-2"></i>A newly established school with 400 students.</p>
            </div>
            <div class="lg:w-1/2">
                <div class="relative w-full h-full">
                    <img class="w-full h-full object-cover rounded-xl shadow-lg" src="{{ asset('images/officeone.jfif') }}" alt="Thamardi Mawlamyine">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Instructors Start -->
<div class="py-16 bg-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <h6 class="text-primary text-lg font-semibold">Instructors</h6>
            <h1 class="text-3xl font-bold text-gray-800">School Founder Information</h1>
        </div>

        <!-- U Sein Win -->
        <div class="flex flex-col lg:flex-row gap-10 mb-12 items-center">
            <div class="lg:w-1/2 text-center">
                <img class="w-3/4 rounded-full shadow-xl mb-6" src="{{ asset('images/instructorone.jfif') }}" alt="U Sein Win">
            </div>
            <div class="lg:w-1/2">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">U Sein Win</h2>
                <ul class="space-y-2 text-gray-600">
                    <li><i class="fas fa-arrow-right text-blue-500 mr-2"></i>Graduated in 1964 and started teaching Math and Science at No.1 B.E.H.S, Meiktila.</li>
                    <li><i class="fas fa-arrow-right text-blue-500 mr-2"></i>Transferred to B.E.H.S Mahlaing, his hometown, in the 1970s.</li>
                </ul>
            </div>
        </div>

        <!-- Daw Kyi Kyi Myint -->
        <div class="flex flex-col lg:flex-row gap-10 items-center">
            <div class="lg:w-1/2 text-center">
                <img class="w-3/4 rounded-full shadow-xl mb-6" src="{{ asset('images/instructortwo.jpg') }}" alt="Daw Kyi Kyi Myint">
            </div>
            <div class="lg:w-1/2">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Daw Kyi Kyi Myint</h2>
                <ul class="space-y-2 text-gray-600">
                    <li><i class="fas fa-arrow-right text-blue-500 mr-2"></i>Began her teaching career in 1974 at Mahlaing B.E.H.S.</li>
                    <li><i class="fas fa-arrow-right text-blue-500 mr-2"></i>Transferred to Meiktila TTC as Assistant Lecturer in 1986 and studied Methodology at University of the Philippines in 1990.</li>
                    <li><i class="fas fa-arrow-right text-blue-500 mr-2"></i>Served as acting headmistress of Meiktila TTC until retirement.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Instructors End -->
 <script>
    document.getElementById('menu-toggle').addEventListener('click', () => {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });

    var swiper = new Swiper(".mySwiper", {
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
</script>

</body>
</html>

