<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MOC Training</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        .swiper {
            width: 100%;
            height: 400px;
        }
        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }
    </style>
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
        <nav class="hidden sm:flex space-x-6 text-sm font-medium">
            <a href="{{ route('login') }}" class="text-black hover:text-blue-500">Login</a>
            <a href="{{ route('register') }}" class="text-black hover:text-blue-500">Register</a>
        </nav>
    </div>
    <div id="mobile-menu" class="sm:hidden hidden px-4 pb-4 space-y-2">
        <a href="{{ route('login') }}" class="block text-black hover:text-blue-300">Login</a>
        <a href="{{ route('register') }}" class="block text-black hover:text-blue-300">Register</a>
    </div>
</header>

<section class="relative h-96 overflow-hidden flex items-center justify-center bg-gray-700">
    <img src="{{ asset('images/officeone.jfif') }}" alt="Office" class="absolute inset-0 w-full h-full object-cover filter blur-sm">
    <div class="absolute inset-0 bg-black opacity-40"></div>
    <div class="relative z-10 text-center px-4 text-white">
        <h1 class="text-3xl md:text-6xl font-bold text-white">Welcome to the Ministry of Commerce</h1>
        <p class="mt-4 text-lg md:text-xl max-w-2xl mx-auto">Empowering businesses and fostering growth in Myanmar</p>
        <a href="#" class="mt-6 inline-block px-8 py-3 bg-blue-500 hover:bg-white text-white hover:text-blue-500 rounded-md text-lg font-semibold transition">Get Started</a>
    </div>
</section>

<!-- Swiper Image Slider -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-6">Gallery</h2>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img src="{{ asset('images/officeone.jfif') }}" alt="Slide 1"></div>
                <div class="swiper-slide"><img src="{{ asset('images/officetwo.jfif') }}" alt="Slide 2"></div>
                <div class="swiper-slide"><img src="{{ asset('images/officeone.jfif') }}" alt="Slide 3"></div>
                <div class="swiper-slide"><img src="{{ asset('images/officetwo.jfif') }}" alt="Slide 4"></div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="container mx-auto text-center px-4">
        <h2 class="text-3xl font-bold mb-10">Our Services</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            <div class="bg-gray-100 p-6 shadow-md rounded-md">
                <img src="{{ asset('images/officeone.jfif') }}" alt="Service 1" class="w-full h-40 object-cover rounded-md mb-4">
                <h3 class="text-xl font-semibold mb-2">Business Licensing</h3>
                <p class="text-gray-700">We provide services for business registrations and licensing.</p>
            </div>
            <div class="bg-gray-100 p-6 shadow-md rounded-md">
                <img src="{{ asset('images/officetwo.jfif') }}" alt="Service 2" class="w-full h-40 object-cover rounded-md mb-4">
                <h3 class="text-xl font-semibold mb-2">Export & Import</h3>
                <p class="text-gray-700">Guiding businesses through import and export processes in Myanmar.</p>
            </div>
            <div class="bg-gray-100 p-6 shadow-md rounded-md">
                <img src="{{ asset('images/officeone.jfif') }}" alt="Service 3" class="w-full h-40 object-cover rounded-md mb-4">
                <h3 class="text-xl font-semibold mb-2">Regulations & Compliance</h3>
                <p class="text-gray-700">Ensuring that your business complies with all national regulations.</p>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-blue-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8">Contact Us</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div>
                <form class="space-y-4">
                    <input type="text" placeholder="Your Name" class="w-full p-3 border border-gray-300 rounded-md">
                    <input type="email" placeholder="Your Email" class="w-full p-3 border border-gray-300 rounded-md">
                    <textarea rows="5" placeholder="Your Message" class="w-full p-3 border border-gray-300 rounded-md"></textarea>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">Send Message</button>
                </form>
            </div>
            <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d244486.6915378337!2d95.86712028671872!3d16.771472999999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1ec7e4aae0865%3A0x160fdab219b4cbb3!2sMinistry%20of%20Commerce!5e0!3m2!1sen!2smm!4v1746610099208!5m2!1sen!2smm" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>

<footer class="bg-blue-700 text-white py-6">
    <div class="container mx-auto text-center px-4">
        <p>&copy; {{ date('Y') }} Ministry of Commerce, Myanmar. All Rights Reserved.</p>
        <div class="mt-4 space-x-4">
            <a href="#" class="text-white hover:text-blue-300">Privacy Policy</a>
            <a href="#" class="text-white hover:text-blue-300">Terms of Service</a>
        </div>
    </div>
</footer>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

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
