<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Admin Dashboard</h1>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <!-- Users Count -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 bg-blue-500 text-white rounded-full">
                    <i class="fas fa-users"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold">Users</h2>
                    <div x-data="animatedCounter({{ $totalUsers }})" class="text-2xl font-bold">
                        <span x-text="count"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Teachers Count -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 bg-green-500 text-white rounded-full">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold">Teachers</h2>
                    <div x-data="animatedCounter({{ $totalTeachers }})" class="text-2xl font-bold">
                        <span x-text="count"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Students Count -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-500 text-white rounded-full">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold">Students</h2>
                    <div x-data="animatedCounter({{ $totalStudents }})" class="text-2xl font-bold">
                        <span x-text="count"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Batches Count -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 bg-purple-500 text-white rounded-full">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold">Batches</h2>
                    <div x-data="animatedCounter({{ $totalBatches }})" class="text-2xl font-bold">
                        <span x-text="count"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Courses Count -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <div class="flex items-center">
                <div class="p-3 bg-red-500 text-white rounded-full">
                    <i class="fas fa-book"></i>
                </div>
                <div class="ml-4">
                    <h2 class="text-lg font-semibold">Courses</h2>
                    <div x-data="animatedCounter({{ $totalCourses }})" class="text-2xl font-bold">
                        <span x-text="count"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
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