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

            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <div class="relative">
                    <input type="text" placeholder="Search courses..." class="w-full md:w-80 px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 pl-10">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <select class="px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 bg-white text-gray-700">
                    <option value="">All Categories</option>
                    <option value="business">Business</option>
                    <option value="finance">Finance</option>
                    <option value="marketing">Marketing</option>
                    <option value="trade">International Trade</option>
                </select>
            </div>
        </div>
    </div>
</section>

<!-- Courses Grid -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="course-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <!-- Course 1 -->
            <div class="course-card bg-white rounded-xl shadow-md overflow-hidden opacity-0 animate-fadeIn" data-tooltip="This course currently has 3 active batches with morning and evening sessions">
                <div class="course-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Business Management" class="course-image w-full h-48 object-cover">
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-blue-800">Business Management</h3>
                        <span class="badge bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">3 Batches</span>
                    </div>
                    <p class="text-gray-600 mb-4">Learn essential business management skills and strategies for success.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-green-600 font-medium flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            Currently Teaching
                        </span>
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm">View Details →</a>
                    </div>
                </div>
            </div>

            <!-- Course 2 -->
            <div class="course-card bg-white rounded-xl shadow-md overflow-hidden opacity-0 animate-fadeIn" data-tooltip="This course currently has 2 active batches with weekend sessions available">
                <div class="course-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1011&q=80" alt="Financial Analysis" class="course-image w-full h-48 object-cover">
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-blue-800">Financial Analysis</h3>
                        <span class="badge bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">2 Batches</span>
                    </div>
                    <p class="text-gray-600 mb-4">Master financial analysis techniques for informed business decisions.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-green-600 font-medium flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            Currently Teaching
                        </span>
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm">View Details →</a>
                    </div>
                </div>
            </div>

            <!-- Course 3 -->
            <div class="course-card bg-white rounded-xl shadow-md overflow-hidden opacity-0 animate-fadeIn" data-tooltip="This course currently has 4 active batches with flexible timing options">
                <div class="course-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Digital Marketing" class="course-image w-full h-48 object-cover">
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-blue-800">Digital Marketing</h3>
                        <span class="badge bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">4 Batches</span>
                    </div>
                    <p class="text-gray-600 mb-4">Learn modern digital marketing strategies to grow your business online.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-green-600 font-medium flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            Currently Teaching
                        </span>
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm">View Details →</a>
                    </div>
                </div>
            </div>

            <!-- Course 4 -->
            <div class="course-card bg-white rounded-xl shadow-md overflow-hidden opacity-0 animate-fadeIn" data-tooltip="This course currently has 1 active batch with limited seats available">
                <div class="course-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Leadership Skills" class="course-image w-full h-48 object-cover">
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-blue-800">Leadership Skills</h3>
                        <span class="badge bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">1 Batch</span>
                    </div>
                    <p class="text-gray-600 mb-4">Develop essential leadership skills to effectively manage teams.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-green-600 font-medium flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            Currently Teaching
                        </span>
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm">View Details →</a>
                    </div>
                </div>
            </div>

            <!-- Course 5 -->
            <div class="course-card bg-white rounded-xl shadow-md overflow-hidden opacity-0 animate-fadeIn" data-tooltip="This course currently has 2 active batches with morning sessions">
                <div class="course-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1115&q=80" alt="Export & Import Procedures" class="course-image w-full h-48 object-cover">
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-blue-800">Export & Import</h3>
                        <span class="badge bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">2 Batches</span>
                    </div>
                    <p class="text-gray-600 mb-4">Master international trade procedures and documentation.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-green-600 font-medium flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            Currently Teaching
                        </span>
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm">View Details →</a>
                    </div>
                </div>
            </div>

            <!-- Course 6 -->
            <div class="course-card bg-white rounded-xl shadow-md overflow-hidden opacity-0 animate-fadeIn" data-tooltip="This course currently has 3 active batches with evening and weekend options">
                <div class="course-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Business Communication" class="course-image w-full h-48 object-cover">
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-blue-800">Business Communication</h3>
                        <span class="badge bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">3 Batches</span>
                    </div>
                    <p class="text-gray-600 mb-4">Enhance your professional communication skills for business success.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-green-600 font-medium flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            Currently Teaching
                        </span>
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm">View Details →</a>
                    </div>
                </div>
            </div>

            <!-- Course 7 -->
            <div class="course-card bg-white rounded-xl shadow-md overflow-hidden opacity-0 animate-fadeIn" data-tooltip="This course currently has 2 active batches with afternoon sessions">
                <div class="course-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Corporate Law" class="course-image w-full h-48 object-cover">
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-blue-800">Corporate Law</h3>
                        <span class="badge bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">2 Batches</span>
                    </div>
                    <p class="text-gray-600 mb-4">Understand legal frameworks and regulations for business operations.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-green-600 font-medium flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            Currently Teaching
                        </span>
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm">View Details →</a>
                    </div>
                </div>
            </div>

            <!-- Course 8 -->
            <div class="course-card bg-white rounded-xl shadow-md overflow-hidden opacity-0 animate-fadeIn" data-tooltip="This course currently has 1 active batch with limited seats remaining">
                <div class="course-image-wrapper">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Data Analytics" class="course-image w-full h-48 object-cover">
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-xl font-bold text-blue-800">Data Analytics</h3>
                        <span class="badge bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">1 Batch</span>
                    </div>
                    <p class="text-gray-600 mb-4">Learn to analyze business data for strategic decision-making.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-green-600 font-medium flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                            Currently Teaching
                        </span>
                        <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm">View Details →</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            <nav class="inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-blue-50">
                    <span class="sr-only">Previous</span>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
                <a href="#" aria-current="page" class="relative inline-flex items-center px-4 py-2 border border-blue-500 bg-blue-50 text-sm font-medium text-blue-600">1</a>
                <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-blue-50">2</a>
                <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-blue-50">3</a>
                <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">...</span>
                <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-blue-50">8</a>
                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-blue-50">
                    <span class="sr-only">Next</span>
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            </nav>
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
