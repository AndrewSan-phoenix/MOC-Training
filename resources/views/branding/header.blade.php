

<!-- Header with enhanced styling and micro-interactions -->
<header class="bg-white shadow-sm sticky top-0 left-0 z-50 transition-all duration-300">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <!-- Logo and Title grouped together, aligned left with negative margin -->
        <div class="flex items-center" style="margin-left: -10px;">
            <a href="/" class="flex items-center space-x-2 transition-transform duration-300 hover:scale-105">
                <img src="{{ asset('images/logoin.png') }}" alt="Logo" class="h-16 z-10 relative">
                <h1 class="text-2xl font-bold text-gray-800 m-0">Trade Training Institute</h1>
            </a>
        </div>
        <!-- ...rest of your header code... -->
        <div class="flex items-center space-x-4">
            <!-- Desktop Navigation with micro-interactions -->
            <nav class="hidden md:flex space-x-8 text-sm font-medium">
                <a href="{{ route('home') }}" class="nav-link text-gray-700 hover:text-blue-700 py-2 transition-colors duration-300">Home</a>
                <a href="{{ route('teacher_index') }}" class="nav-link text-gray-700 hover:text-blue-700 py-2 transition-colors duration-300">Teachers</a>
                <a href="{{ route('student_index') }}" class="nav-link text-gray-700 hover:text-blue-700 py-2 transition-colors duration-300">Students</a>
                <a href="{{ route('course_index') }}" class="nav-link text-gray-700 hover:text-blue-700 py-2 transition-colors duration-300">Courses</a>
                <a href="{{ route('batch_index') }}" class="nav-link text-gray-700 hover:text-blue-700 py-2 transition-colors duration-300">Batches</a>
                <a href="{{ route('gallery_index') }}" class="nav-link text-gray-700 hover:text-blue-700 py-2 transition-colors duration-300">Galleries</a>
            </nav>

            <!-- Auth buttons with enhanced styling -->
            <!-- <div class="hidden md:flex space-x-3">
                @auth
                <a href="{{ route('login') }}" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-medium transition-all duration-300 hover:shadow-lg transform hover:-translate-y-0.5">Login</a>
                <a href="{{ route('register') }}" class="px-5 py-2 border-2 border-blue-600 text-blue-600 hover:bg-blue-50 rounded-md text-sm font-medium transition-all duration-300 hover:shadow-md">Register</a>
                @endauth
            </div> -->

            <!-- Mobile menu button with animation -->
            <button id="menu-toggle" class="md:hidden text-white bg-blue-700 p-2 rounded-md hover:bg-blue-800 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" class="transition-all duration-300"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation with slide animation -->
    <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-100 shadow-inner transition-all duration-300 transform -translate-y-2 opacity-0">
        <div class="container mx-auto px-4 py-3 space-y-3">
            <a href="{{ route('home') }}" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-md transition-colors duration-300">Home</a>
            <a href="{{ route('teacher_index') }}" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-md transition-colors duration-300">Teachers</a>
            <a href="{{ route('student_index') }}" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-md transition-colors duration-300">Students</a>
            <a href="{{ route('course_index') }}" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-md transition-colors duration-300">Courses</a>
            <a href="{{ route('batch_index') }}" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-md transition-colors duration-300">Batches</a>
            <a href="{{ route('gallery_index') }}" class="block py-2 px-4 text-gray-700 hover:bg-blue-50 hover:text-blue-700 rounded-md transition-colors duration-300">Galleries</a>
           
            <!-- Mobile auth buttons -->
            <!-- @auth
            <div class="grid grid-cols-2 gap-3 pt-2">
                <a href="{{ route('login') }}" class="text-center py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-sm font-medium transition-all duration-300">Login</a>
                <a href="{{ route('register') }}" class="text-center py-2 border border-blue-600 text-blue-600 hover:bg-blue-50 rounded-md text-sm font-medium transition-all duration-300">Register</a>
            </div>
            @endauth -->
        </div>
    </div>
</header>



