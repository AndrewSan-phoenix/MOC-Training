<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to MOC Training</title>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts (similar font to MOC website) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body class="font-sans bg-gray-50">

    <!-- Header Section -->
    <header class="bg-light-700 text-white shadow-md">
        <div class="container mx-auto flex items-center justify-between p-4">
            <!-- Logo -->
            <a href="/" class="text-xl font-bold">
                <img src="{{ asset('images/logo.png') }}" alt="MOC Logo" class="h-10">
            </a>
            
            <!-- Navigation Menu -->
            <nav>
                <ul class="flex space-x-6 text-sm font-medium">
                    <li><a href="#" class="hover:text-gray-300">Home</a></li>
                    <li><a href="#" class="hover:text-gray-300">About</a></li>
                    <li><a href="#" class="hover:text-gray-300">Services</a></li>
                    <li><a href="#" class="hover:text-gray-300">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-cover bg-center h-[500px]" style="background-image: url('{{ asset('images/officeone.jfif') }}');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 flex justify-center items-center h-full text-center text-white">
           
            <p class="mt-4 text-lg lg:text-xl">Empowering businesses and fostering growth in Myanmar</p><br/>
            <button class="mt-6 px-8 py-3 bg-blue-500 hover:bg-blue-600 rounded-md text-lg font-semibold transition duration-300">Get Started</button>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold mb-8">Our Services</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <div class="p-6 bg-gray-100 shadow-md rounded-lg">
                    <img src="{{ asset('images/officeone.jfif') }}" alt="Service 1" class="w-full h-40 object-cover rounded-md mb-4">
                    <h3 class="text-xl font-semibold mb-2">Business Licensing</h3>
                    <p class="text-gray-700">We provide services for business registrations and licensing.</p>
                </div>
                <div class="p-6 bg-gray-100 shadow-md rounded-lg">
                    <img src="{{ asset('images/officetwo.jfif') }}" alt="Service 2" class="w-full h-40 object-cover rounded-md mb-4">
                    <h3 class="text-xl font-semibold mb-2">Export & Import</h3>
                    <p class="text-gray-700">Guiding businesses through import and export processes in Myanmar.</p>
                </div>
                <div class="p-6 bg-gray-100 shadow-md rounded-lg">
                    <img src="{{ asset('images/officeone.jfif') }}" alt="Service 3" class="w-full h-40 object-cover rounded-md mb-4">
                    <h3 class="text-xl font-semibold mb-2">Regulations & Compliance</h3>
                    <p class="text-gray-700">Ensuring that your business complies with all national regulations.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-blue-700 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} Ministry of Commerce, Myanmar. All Rights Reserved.</p>
            <div class="mt-4">
                <a href="#" class="hover:text-gray-300 mx-2">Privacy Policy</a>
                <a href="#" class="hover:text-gray-300 mx-2">Terms of Service</a>
            </div>
        </div>
    </footer>

</body>

</html>
