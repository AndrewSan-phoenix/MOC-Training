<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f3f4f6; /* zinc-100 */
            color: #18181b; /* zinc-900 */
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .dark body {
            background-color: #27272a; /* zinc-800 */
            color: #fafafa; /* zinc-50 */
        }

        .sidebar-nav {
            width: 226px; /* A bit wider for better initial display of labels */
            background: linear-gradient(180deg, #1e40af 0%, #1e3a8a 100%); /* blue-800 to blue-900 */
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* shadow-xl */
            z-index: 40;
            display: flex;
            flex-direction: column;
            transition: width 0.3s ease-in-out;
            position: fixed; /* Make the sidebar fixed */
            top: 0;
            left: 0;
            height: 100vh; /* Make it take full viewport height */
            overflow-y: auto; /* Enable scrolling for sidebar content if it exceeds viewport height */
        }

        .dark .sidebar-nav {
            background: linear-gradient(180deg, #1e3a8a 0%, #172554 100%); /* blue-900 to blue-950 */
        }

        .sidebar-collapsed {
            width: 92px !important;
            overflow: hidden;
        }

        .sidebar-collapsed .sidebar-label {
            display: none;
        }

        .sidebar-collapsed .sidebar-toggle {
            justify-content: center;
        }

        .sidebar-collapsed .sidebar-nav {
            width: 36px !important; /* This rule seems redundant with the .sidebar-collapsed directly above. Consider merging or clarifying. */
        }

        .sidebar-link {
            position: relative;
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 1.25rem;
            color: #cbd5e1; /* slate-300 */
            border-radius: 0.5rem;
            font-weight: 500;
            transition: color 0.2s;
            overflow: hidden;
        }

        .sidebar-link .sidebar-icon {
            min-width: 1.5rem;
            min-height: 1.5rem;
        }

        .sidebar-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #38bdf8 0%, #2563eb 100%); /* sky-400 to blue-700 */
            opacity: 0;
            transition: opacity 0.2s;
            border-radius: 4px;
        }

        .sidebar-link:hover, .sidebar-link.active {
            color: #fff;
        }

        .sidebar-link:hover::before, .sidebar-link.active::before {
            opacity: 1;
        }

        .sidebar-link:hover .sidebar-icon, .sidebar-link.active .sidebar-icon {
            color: #38bdf8; /* sky-400 */
        }

        .sidebar-toggle-btn {
            background: none;
            border: none;
            outline: none;
            cursor: pointer;
            color: #cbd5e1; /* slate-300 */
            padding: 0.75rem 1.25rem;
            width: 100%;
            display: flex;
            align-items: center;
            font-size: 1.5rem;
            transition: color 0.2s;
        }

        .sidebar-toggle-btn:hover {
            color: #38bdf8; /* sky-400 */
        }

        .sidebar-profile {
            padding: 1.25rem;
            border-top: 1px solid #334155; /* slate-700 */
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-shrink: 0; /* Prevent the profile section from shrinking */
        }

        .sidebar-profile .avatar {
            width: 2.5rem;
            height: 2.5rem;
            background: #38bdf8; /* sky-400 */
            color: #fff;
            border-radius: 9999px; /* full rounded */
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.25rem;
        }

        .sidebar-collapsed .sidebar-profile .sidebar-label {
            display: none;
        }

        .sidebar-label{
            font-size:15px !important;
        }
        .sidebar-icon{
            font-size:10px !important;
        }

        .main-content-wrapper {
            margin-left: 256px; /* Adjust this to match the initial sidebar width */
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease-in-out;
        }

        .sidebar-collapsed + .main-content-wrapper {
            margin-left: 92px; /* Adjust this to match the collapsed sidebar width */
        }

        @media (max-width: 1024px) {
            .sidebar-nav {
                width: 0 !important; /* Hide sidebar completely on mobile by default */
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }

            .sidebar-nav.sidebar-open-mobile {
                width: 256px !important; /* Full width when open on mobile */
                transform: translateX(0);
            }
           
            .sidebar-collapsed {
                width: 56px !important; /* Full width when open on mobile */
                transform: translateX(0);
            }
           
            .sidebar-label {
                /* display: none !important; */
            }

            .main-content-wrapper {
                margin-left: 0; /* No margin on mobile, sidebar will overlay */
            }

            .header-mobile {
                display: flex !important; /* Show mobile header */
            }
        }

          @media (max-width: 1024px) {
            .sidebar-nav {
                width: 0 !important; /* Hide sidebar completely on mobile by default */
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }

            .sidebar-nav.sidebar-open-mobile {
                width: 256px !important; /* Full width when open on mobile */
                transform: translateX(0);
            }
           
            .sidebar-collapsed {
                width: 56px !important; /* Full width when open on mobile */
                transform: translateX(0);
            }
           
            .sidebar-label {
                /* display: none !important; */
            }

            .main-content-wrapper {
                margin-left: 0; /* No margin on mobile, sidebar will overlay */
            }

            .header-mobile {
                display: flex !important; /* Show mobile header */
            }
        }
    </style>
</head>
<body class="min-h-screen antialiased">
    {{-- Sidebar --}}
    <nav id="sidebarNav" class="sidebar-nav">
        {{-- Toggle Button --}}
        <div class="sidebar-toggle flex items-center justify-end p-2">
            <button class="sidebar-toggle-btn" id="sidebarToggleBtn" title="Toggle Sidebar">
                <span id="sidebarToggleIcon">
                    <svg id="sidebarOpenIcon" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="#fff">
                        <circle cx="12" cy="12" r="10" stroke-width="2"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h8"/>
                    </svg>
                    <svg id="sidebarCloseIcon" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="#fff" style="display:none;" viewBox="-0.72 -0.72 25.44 25.44" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#fff">
                    <circle cx="12" cy="12" r="10" stroke="#fff" stroke-width="2">
                    </circle>
                     <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" stroke="#fff" stroke-width="2" stroke-linecap="round"></path> 
                    </svg>

                    <!-- <svg id="sidebarCloseIcon" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display:none;">
                        <circle cx="12" cy="12" r="10" stroke-width="2"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8"/>
                    </svg> -->
                    
                </span>
                
            </button>
           
        </div>
          <span class="text-white text-wrap hover:bg-gray-600" style="font-weight:bold; font-size:18px; margin-left:12px; cursor:pointer;">Trade Training Institute</span>
        {{-- Navigation --}}
        <div class="flex-1 flex flex-col gap-2 mt-2 overflow-y-auto"> {{-- Add overflow-y-auto here for scrollable navigation --}}
            <a href="{{ route('dashboard') }}" class="sidebar-link{{ request()->routeIs('dashboard') ? ' active' : '' }}">
                <span class="sidebar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3m-4 0h4"/></svg>
                </span>
                <span class="sidebar-label">Dashboard</span>
            </a>
            <a href="{{ route('student') }}" class="sidebar-link{{ request()->routeIs('student') ? ' active' : '' }}">
                <span class="sidebar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 3.13a4 4 0 010 7.75M8 3.13a4 4 0 000 7.75"/></svg>
                </span>
                <span class="sidebar-label">Students</span>
            </a>
            <a href="{{ route('teacher') }}" class="sidebar-link{{ request()->routeIs('teacher') ? ' active' : '' }}">
                <span class="sidebar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.797.657 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </span>
                <span class="sidebar-label">Teacher</span>
            </a>
            <a href="{{ route('batch') }}" class="sidebar-link{{ request()->routeIs('batch') ? ' active' : '' }}">
                <span class="sidebar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><rect width="20" height="8" x="2" y="6" rx="2"/><path d="M2 10h20"/></svg>
                </span>
                <span class="sidebar-label">Batch</span>
            </a>
            <a href="{{ route('course') }}" class="sidebar-link{{ request()->routeIs('course') ? ' active' : '' }}">
                <span class="sidebar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 20h9M12 4h9M3 6v12a2 2 0 002 2h7V4H5a2 2 0 00-2 2z"/></svg>
                </span>
                <span class="sidebar-label">Course</span>
            </a>
            <a href="{{ route('enroll') }}" class="sidebar-link{{ request()->routeIs('enroll') ? ' active' : '' }}">
                <span class="sidebar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m-6 4h6a2 2 0 002-2V7a2 2 0 00-2-2h-1.5a1.5 1.5 0 01-3 0H9a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </span>
                <span class="sidebar-label">Enroll</span>
            </a>
            <a href="{{ route('batchdetails') }}" class="sidebar-link{{ request()->routeIs('batchdetails') ? ' active' : '' }}">
                <span class="sidebar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10m-7 4h7"/></svg>
                </span>
                <span class="sidebar-label">BatchDetails</span>
            </a>
            <a href="{{ route('gallery') }}" class="sidebar-link{{ request()->routeIs('gallery') ? ' active' : '' }}">
                <span class="sidebar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><rect width="20" height="14" x="2" y="5" rx="2"/><circle cx="12" cy="12" r="3"/></svg>
                </span>
                <span class="sidebar-label">Gallery</span>
            </a>
        </div>
        {{-- Profile --}}
        <div class="sidebar-profile">
            <div class="sidebar-label flex-1">
                <div class="font-semibold text-white truncate">{{ auth()->user()->name }}</div>
                <div class="text-xs text-blue-200 truncate">{{ auth()->user()->email }}</div>
            </div>
            {{-- Profile Dropdown --}}
            <flux:dropdown position="top" align="end" class="flex-shrink-0">
                <flux:profile
                    icon-trailing="chevron-down"
                    class="text-blue-100 hover:text-white transition-colors duration-200 cursor-pointer"
                />
                <flux:menu class="bg-white dark:bg-zinc-700 rounded-lg shadow-lg overflow-hidden border border-zinc-200 dark:border-zinc-600">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-3 py-2.5 text-start text-sm">
                                <span class="relative flex h-10 w-10 shrink-0 overflow-hidden rounded-full">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-full bg-blue-200 text-blue-800 font-semibold text-lg dark:bg-blue-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>
                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold text-zinc-900 dark:text-white">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs text-zinc-600 dark:text-zinc-300">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>
                    <flux:menu.separator class="bg-zinc-200 dark:bg-zinc-600" />
                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" class="flex items-center gap-2 px-3 py-2 text-sm text-zinc-700 hover:bg-zinc-100 dark:text-zinc-200 dark:hover:bg-zinc-600 transition-colors duration-150 rounded-md">
                            {{ __('Settings') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>
                    <flux:menu.separator class="bg-zinc-200 dark:bg-zinc-600" />
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full flex items-center gap-2 px-3 py-2 text-sm text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-zinc-700/50 transition-colors duration-150 rounded-md">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </div>
    </nav>
    {{-- Main Content --}}
    <div class="main-content-wrapper">
        <header class="header-mobile hidden lg:hidden items-center justify-between bg-blue-700 dark:bg-blue-900 border-b border-blue-800 dark:border-blue-900 shadow-md p-4 sticky top-0 z-30">
            <button class="sidebar-toggle-btn" id="sidebarToggleBtnMobile" title="Toggle Sidebar">
                <span id="sidebarToggleIconMobile">
                    <svg id="sidebarOpenIconMobile" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <circle cx="12" cy="12" r="10" stroke-width="2"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h8"/>
                    </svg>
                    <svg id="sidebarCloseIconMobile" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display:none;">
                        <circle cx="12" cy="12" r="10" stroke-width="2"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8"/>
                    </svg>
                </span>
            </button>
            <div class="flex items-center gap-2">
                <span class="avatar">{{ auth()->user()->initials() }}</span>
                <span class="text-white font-semibold">{{ auth()->user()->name }}</span>
            </div>
        </header>
        <main class="flex-1 flex flex-col">
            {{ $slot }}
        </main>
    </div>
    <script>
        // Sidebar toggle logic
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebarNav');
            const mainContent = document.querySelector('.main-content-wrapper');
            sidebar.classList.toggle('sidebar-collapsed');
            mainContent.classList.toggle('sidebar-collapsed'); // Toggle class on main content
            // Toggle icon for desktop
            const openIcon = document.getElementById('sidebarOpenIcon');
            const closeIcon = document.getElementById('sidebarCloseIcon');
            if (sidebar.classList.contains('sidebar-collapsed')) {
                openIcon.style.display = 'none';
                closeIcon.style.display = '';
            } else {
                openIcon.style.display = '';
                closeIcon.style.display = 'none';
            }
        }

        // Mobile sidebar toggle logic
        function toggleSidebarMobile() {
            const sidebar = document.getElementById('sidebarNav');
            sidebar.classList.toggle('sidebar-open-mobile'); // Use a different class for mobile
            const openIcon = document.getElementById('sidebarOpenIconMobile');
            const closeIcon = document.getElementById('sidebarCloseIconMobile');

            if (sidebar.classList.contains('sidebar-open-mobile')) {
                openIcon.style.display = 'none';
                closeIcon.style.display = '';
            } else {
                openIcon.style.display = '';
                closeIcon.style.display = 'none';
            }
        }

        document.getElementById('sidebarToggleBtn').addEventListener('click', toggleSidebar);
        document.getElementById('sidebarToggleBtnMobile').addEventListener('click', toggleSidebarMobile);

        // Close mobile sidebar if clicked outside (optional, but good for UX)
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebarNav');
            const mobileToggleBtn = document.getElementById('sidebarToggleBtnMobile');
            // Check if the click is outside the sidebar and not on the mobile toggle button
            if (window.innerWidth <= 1024 && !sidebar.contains(event.target) && !mobileToggleBtn.contains(event.target) && sidebar.classList.contains('sidebar-open-mobile')) {
                toggleSidebarMobile();
            }
        });
    </script>
    @fluxScripts
</body>
</html>