<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        {{-- You might need to adjust partials.head to include your main CSS compiled by Tailwind --}}
        <style>
            /* Custom Scrollbar for the sidebar (optional, but enhances blue theme) */
            .custom-scrollbar::-webkit-scrollbar {
                width: 8px; /* width of the scrollbar */
            }

            .custom-scrollbar::-webkit-scrollbar-track {
                background: theme('colors.blue.800'); /* color of the tracking area */
                border-radius: 10px;
            }

            .custom-scrollbar::-webkit-scrollbar-thumb {
                background-color: theme('colors.blue.400'); /* color of the scroll thumb */
                border-radius: 10px; /* roundness of the scroll thumb */
                border: 2px solid theme('colors.blue.800'); /* creates padding around scroll thumb */
            }

            .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                background-color: theme('colors.blue.300');
            }

            /* Ensure the sidebar z-index is higher than other content if needed for overlays */
            .z-sidebar {
                z-index: 40; /* Tailwind's z-40, adjust if needed */
            }
        </style>
    </head>
    <body class="min-h-screen bg-zinc-100 dark:bg-zinc-800 antialiased font-sans">

        {{-- Main Layout Container (optional, but good practice for full-height layouts) --}}
        <div class="flex min-h-screen">

            <flux:sidebar
                sticky
                stashable
                class="group
                       flex flex-col
                       bg-gradient-to-br from-blue-700 to-blue-900 dark:from-blue-800 dark:to-blue-950
                       border-e border-blue-900 dark:border-blue-900
                       transform -translate-x-full
                       transition-all duration-500 ease-in-out
                       lg:translate-x-0 lg:w-54 lg:flex-shrink-0
                       shadow-xl z-sidebar
                       overflow-y-auto custom-scrollbar
                       "
            >
                {{-- Sidebar Toggle for Mobile (positioned inside the sidebar) --}}
                <div class="p-4 flex justify-end lg:hidden">
                    <flux:sidebar.toggle class="text-blue-100 hover:text-white transition-colors duration-200" icon="x-mark" />
                </div>

                
                {{-- Navigation List --}}
                <flux:navlist variant="outline" class="flex-grow px-4 pb-4">
                    <flux:navlist.group class="grid gap-1 mb-6">
                        <h1 class="text-white text-xs uppercase tracking-wider font-bold mb-2 px-3">
                            Trade Training Institute
                        </h1>

                        <flux:navlist.item
                            icon="home"
                            :href="route('dashboard')"
                            :current="request()->routeIs('dashboard')"
                            class="flex items-center p-3 text-blue-100 hover:text-white **hover:bg-blue-600**
                                   dark:hover:bg-blue-800/50 transition-all duration-250 ease-in-out
                                   rounded-lg shadow-sm hover:shadow-lg focus:outline-none focus:ring-2
                                   focus:ring-blue-400 focus:ring-opacity-75 mb-1
                                   {{ request()->routeIs('dashboard') ? '!bg-blue-600 !text-white shadow-xl' : '' }}"
                        >
                            <span class="w-6 h-6 mr-3"></span>{{-- Icon placeholder --}}
                            {{ __('Dashboard') }}
                        </flux:navlist.item>

                        <flux:navlist.item
                            icon="users"
                            :href="route('student')"
                            :current="request()->routeIs('student')"
                            class="flex items-center p-3 text-blue-100 hover:text-white **hover:bg-blue-600**
                                   dark:hover:bg-blue-800/50 transition-all duration-250 ease-in-out
                                   rounded-lg shadow-sm hover:shadow-lg focus:outline-none focus:ring-2
                                   focus:ring-blue-400 focus:ring-opacity-75 mb-1
                                   {{ request()->routeIs('student') ? '!bg-blue-600 !text-white shadow-xl' : '' }}"
                        >
                            <span class="w-6 h-6 mr-3"></span>{{-- Icon placeholder --}}
                            {{ __('Students') }}
                        </flux:navlist.item>

                        <flux:navlist.item
                            icon="users"
                            :href="route('teacher')"
                            :current="request()->routeIs('teacher')"
                            class="flex items-center p-3 text-blue-100 hover:text-white **hover:bg-blue-600**
                                   dark:hover:bg-blue-800/50 transition-all duration-250 ease-in-out
                                   rounded-lg shadow-sm hover:shadow-lg focus:outline-none focus:ring-2
                                   focus:ring-blue-400 focus:ring-opacity-75 mb-1
                                   {{ request()->routeIs('teacher') ? '!bg-blue-600 !text-white shadow-xl' : '' }}"
                        >
                            <span class="w-6 h-6 mr-3"></span>{{-- Icon placeholder --}}
                            {{ __('Teacher') }}
                        </flux:navlist.item>

                        <flux:navlist.item
                            icon="users"
                            :href="route('batch')"
                            :current="request()->routeIs('batch')"
                            class="flex items-center p-3 text-blue-100 hover:text-white **hover:bg-blue-600**
                                   dark:hover:bg-blue-800/50 transition-all duration-250 ease-in-out
                                   rounded-lg shadow-sm hover:shadow-lg focus:outline-none focus:ring-2
                                   focus:ring-blue-400 focus:ring-opacity-75 mb-1
                                   {{ request()->routeIs('batch') ? '!bg-blue-600 !text-white shadow-xl' : '' }}"
                        >
                            <span class="w-6 h-6 mr-3"></span>{{-- Icon placeholder --}}
                            {{ __('Batch') }}
                        </flux:navlist.item>

                        <flux:navlist.item
                            icon="users"
                            :href="route('course')"
                            :current="request()->routeIs('course')"
                            class="flex items-center p-3 text-blue-100 hover:text-white **hover:bg-blue-600**
                                   dark:hover:bg-blue-800/50 transition-all duration-250 ease-in-out
                                   rounded-lg shadow-sm hover:shadow-lg focus:outline-none focus:ring-2
                                   focus:ring-blue-400 focus:ring-opacity-75 mb-1
                                   {{ request()->routeIs('course') ? '!bg-blue-600 !text-white shadow-xl' : '' }}"
                        >
                            <span class="w-6 h-6 mr-3"></span>{{-- Icon placeholder --}}
                            {{ __('Course') }}
                        </flux:navlist.item>

                        <flux:navlist.item
                            icon="users"
                            :href="route('enroll')"
                            :current="request()->routeIs('enroll')"
                            class="flex items-center p-3 text-blue-100 hover:text-white **hover:bg-blue-600**
                                   dark:hover:bg-blue-800/50 transition-all duration-250 ease-in-out
                                   rounded-lg shadow-sm hover:shadow-lg focus:outline-none focus:ring-2
                                   focus:ring-blue-400 focus:ring-opacity-75 mb-1
                                   {{ request()->routeIs('enroll') ? '!bg-blue-600 !text-white shadow-xl' : '' }}"
                        >
                            <span class="w-6 h-6 mr-3"></span>{{-- Icon placeholder --}}
                            {{ __('Enroll') }}
                        </flux:navlist.item>

                        <flux:navlist.item
                            icon="users"
                            :href="route('batchdetails')"
                            :current="request()->routeIs('batchdetails')"
                            class="flex items-center p-3 text-blue-100 hover:text-white **hover:bg-blue-600**
                                   dark:hover:bg-blue-800/50 transition-all duration-250 ease-in-out
                                   rounded-lg shadow-sm hover:shadow-lg focus:outline-none focus:ring-2
                                   focus:ring-blue-400 focus:ring-opacity-75 mb-1
                                   {{ request()->routeIs('batchdetails') ? '!bg-blue-600 !text-white shadow-xl' : '' }}"
                        >
                            <span class="w-6 h-6 mr-3"></span>{{-- Icon placeholder --}}
                            {{ __('BatchDetails') }}
                        </flux:navlist.item>

                        <flux:navlist.item
                            icon="users"
                            :href="route('gallery')"
                            :current="request()->routeIs('gallery')"
                            class="flex items-center p-3 text-blue-100 hover:text-white **hover:bg-blue-600**
                                   dark:hover:bg-blue-800/50 transition-all duration-250 ease-in-out
                                   rounded-lg shadow-sm hover:shadow-lg focus:outline-none focus:ring-2
                                   focus:ring-blue-400 focus:ring-opacity-75 mb-1
                                   {{ request()->routeIs('gallery') ? '!bg-blue-600 !text-white shadow-xl' : '' }}"
                        >
                            <span class="w-6 h-6 mr-3"></span>{{-- Icon placeholder --}}
                            {{ __('Gallery') }}
                        </flux:navlist.item>

                    </flux:navlist.group>
                </flux:navlist>

                <flux:spacer /> {{-- This spacer pushes the profile section to the bottom --}}

                <div class="p-4 border-t border-blue-800 mt-auto"> {{-- Add top border to separate --}}
                    <flux:dropdown position="bottom" align="start">
                        <flux:profile
                            :name="auth()->user()->name"
                            :initials="auth()->user()->initials()"
                            icon-trailing="chevrons-up-down"
                            class="text-blue-100 hover:text-white transition-colors duration-200 cursor-pointer p-2 rounded-lg hover:bg-blue-700/50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75"
                        />

                        <flux:menu class="w-[220px] bg-white dark:bg-zinc-700 rounded-lg shadow-lg overflow-hidden border border-zinc-200 dark:border-zinc-600">
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
                                </flux:menu.menu.item>
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
            </flux:sidebar>

            {{-- Main Content Area --}}
            <div class="flex-grow flex flex-col">
                <flux:header class="lg:hidden
                                   flex items-center justify-between
                                   bg-blue-700 dark:bg-blue-900
                                   border-b border-blue-800 dark:border-blue-900
                                   shadow-md p-4 sticky top-0 z-30">
                    <flux:sidebar.toggle class="text-white hover:text-blue-100 transition-colors duration-200" icon="bars-2" inset="left" />

                    <flux:dropdown position="top" align="end">
                        <flux:profile
                            :initials="auth()->user()->initials()"
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
                </flux:header>

                {{ $slot }} {{-- This is where your page content will be injected --}}
            </div>

        </div> {{-- End of Main Layout Container --}}

        @fluxScripts
    </body>
</html>