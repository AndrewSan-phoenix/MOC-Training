@extends('branding.layouts')
@section('content')


<!-- Page Header -->
<section class="relative py-16 bg-gradient-to-r from-blue-800 to-blue-600">
    <div class="absolute inset-0 overflow-hidden">
        <svg class="absolute left-0 bottom-0 h-full w-full text-white opacity-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="currentColor" fill-opacity="1" d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,224C1248,203,1344,181,1392,170.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center text-white max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-white">Our Courses</h1>
            <p class="text-lg md:text-xl text-blue-100">Explore our comprehensive range of courses designed to enhance your skills and knowledge in various domains of commerce and business.</p>

           
        </div>
    </div>
</section>

<!-- Courses Grid -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="course-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4 gap-8">
            <!-- Course 1 -->
            <div class="course-card bg-white rounded-xl shadow-md overflow-hidden opacity-0 animate-fadeIn" data-tooltip="This course currently has 3 active batches with morning and evening sessions">
                <div class="course-image-wrapper">
                       <img src="{{ asset('images/coursepage1.png') }}" alt="International Trade (Basic Course)" class="course-image w-full h-48 object-cover">   
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-blue-800">International Trade (Basic Course)​</h3>
                        
                        <span class="badge bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">1 Batch</span>
                    </div>
                    <p class="text-gray-600 mb-4">Learn essential business management skills and strategies for success.</p>
                    <div class="flex justify-between items-center">
                        <!-- <span class="text-sm text-green-600 font-medium flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            Currently Teaching
                        </span> -->
                        <!-- <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm">View Details →</a> -->
                    </div>
                </div>
            </div>

            <!-- Course 2 -->
            <div class="course-card bg-white rounded-xl shadow-md overflow-hidden opacity-0 animate-fadeIn" data-tooltip="This course currently has 2 active batches with weekend sessions available">
                <div class="course-image-wrapper">
                <img src="{{ asset('images/coursepage2.png') }}" alt="International Trade (Basic Course)" class="course-image w-full h-48 object-cover">   
                    
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-blue-800">International Trade (Advanced Course)</h3>
                        <span class="badge bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">3 Batches</span>
                    </div>
                    <p class="text-gray-600 mb-4">Master financial analysis techniques for informed business decisions.</p>
                    <div class="flex justify-between items-center">
                        <!-- <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm">View Details →</a> -->
                    </div>
                </div>
            </div>

            <!-- Course 3 -->
            <div class="course-card bg-white rounded-xl shadow-md overflow-hidden opacity-0 animate-fadeIn" data-tooltip="This course currently has 4 active batches with flexible timing options">
                <div class="course-image-wrapper">
                <img src="{{ asset('images/coursepage3.png') }}" alt="International Trade (Basic Course)" class="course-image w-full h-48 object-cover">   
                   
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-blue-800">International Trade (Weekend Course)</h3>
                        <span class="badge bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">2 Batches</span>
                    </div>
                    <p class="text-gray-600 mb-4">Learn modern digital marketing strategies to grow your business online.</p>
                    <div class="flex justify-between items-center">
                        <!-- <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm">View Details →</a> -->
                    </div>
                </div>
            </div>

            <!-- Course 4 -->
            <div class="course-card bg-white rounded-xl shadow-md overflow-hidden opacity-0 animate-fadeIn" data-tooltip="This course currently has 1 active batch with limited seats available">
                <div class="course-image-wrapper">
                <img src="{{ asset('images/10.png') }}" alt="International Trade (Basic Course)" class="course-image w-full h-48 object-cover">   
                    
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-blue-800">Short Course on (How to Start Export Business in Myanmar)</h3>
                        <span class="badge bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">2 Batches</span>
                    </div>
                    <p class="text-gray-600 mb-4">Develop essential leadership skills to effectively manage teams.</p>
                    <div class="flex justify-between items-center">
                        <!-- <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm">View Details →</a> -->
                    </div>
                </div>
            </div>

        </div>

       
    </div>
</section>

<!-- Call to Action -->
<section class="py-16 bg-blue-50">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-blue-800 mb-4">Ready to Enhance Your Skills?</h2>
        <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">Join our courses today and take the first step towards advancing your career in commerce and business.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="#" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-md text-lg font-medium transition-all duration-300 hover:shadow-lg transform hover:-translate-y-1">Enroll Now</a>
            <a href="#" class="px-8 py-3 border-2 border-blue-600 text-blue-600 hover:bg-blue-100 rounded-md text-lg font-medium transition-all duration-300">Request Information</a>
        </div>
    </div>
</section>





@endsection
