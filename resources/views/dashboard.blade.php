<x-layouts.app :title="__('Admin Dashboard')">
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-bold mb-8 text-center text-gray-800 dark:text-gray-100">Admin Dashboard</h1>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <!-- Users Count -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-lg rounded-xl p-8">
                <div class="flex items-center">
                    <div class="p-4 text-white-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                    </div>
                    <div class="ml-6">
                        <h2 class="text-xl text-white font-semibold">Users</h2>
                        <div x-data="animatedCounter({{ $totalUsers }})" class="text-4xl font-bold mt-2">
                            <span x-text="count"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Other Stats (Teachers, Students, etc.) -->
            <!-- Add similar blocks for Teachers, Students, Batches, and Courses -->
              <!-- Teachers Count -->
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white shadow-lg rounded-xl p-8">
                <div class="flex items-center">
                    <div class="p-4  text-white-500">
                        <i class="fa-solid fa-chalkboard-user fa-2x"></i>
                    </div>
                    <div class="ml-6">
                        <h2 class="text-xl text-white font-semibold">Teachers</h2>
                        <div x-data="animatedCounter({{ $totalTeachers }})" class="text-4xl font-bold mt-2">
                            <span x-text="count"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Students Count -->
            <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 text-white shadow-lg rounded-xl p-8">
                <div class="flex items-center">
                    <div class="p-4 text-black-500 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
  <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
</svg>

                </div>
                    <div class="ml-6">
                        <h2 class="text-xl text-white font-semibold">Students</h2>
                        <div x-data="animatedCounter({{ $totalStudents }})" class="text-4xl font-bold mt-2">
                            <span x-text="count"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Batches Count -->
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white shadow-lg rounded-xl p-8">
                <div class="flex items-center">
                    <div class="p-4  text-white-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
  <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
</svg>

                    </div>
                    <div class="ml-6">
                        <h2 class="text-xl text-white font-semibold">Batches</h2>
                        <div x-data="animatedCounter({{ $totalBatches }})" class="text-4xl font-bold mt-2">
                            <span x-text="count"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Courses Count -->
            <div class="bg-gradient-to-r from-red-500 to-red-600 text-white shadow-lg rounded-xl p-8">
                <div class="flex items-center">
                    <div class="p-4 text-white-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
  <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
</svg>

                    </div>
                    <div class="ml-6">
                        <h2 class="text-xl text-white font-semibold">Courses</h2>
                        <div x-data="animatedCounter({{ $totalCourses }})" class="text-4xl font-bold mt-2">
                            <span x-text="count"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
       

        <!-- Batch Chart -->
        @livewire('dashboard.batch-chart')
    </div>

    <!-- Alpine.js Animated Counter -->
    <script>
        function animatedCounter(target) {
            return {
                count: 0,
                init() {
                    const interval = 50; // Animation speed
                    const increment = Math.ceil(target / 100); // Increment step
                    const timer = setInterval(() => {
                        if (this.count < target) {
                            this.count += increment;
                        } else {
                            this.count = target;
                            clearInterval(timer);
                        }
                    }, interval);
                }
            };
        }
    </script>
</x-layouts.app>