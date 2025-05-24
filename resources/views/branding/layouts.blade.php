<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trade Training Institue (TTI)</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <style>
        /* Base styles */
        html {
            scroll-behavior: smooth;
        }

        /* Swiper customization */
        .swiper {
            width: 100%;
            height: auto;
            max-height: 500px;
        }
        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 12px;
            transition: transform 0.3s ease;
        }
        .swiper-slide:hover img {
            transform: scale(1.02);
        }
        .swiper-pagination-bullet {
            width: 10px;
            height: 10px;
            background: #003087;
            opacity: 0.5;
        }
        .swiper-pagination-bullet-active {
            opacity: 1;
            background: #003087;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.5s ease forwards;
        }

        /* Micro-interactions */
        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #003087;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }

        /* Card hover effects */
        .service-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 48, 135, 0.1), 0 8px 10px -6px rgba(0, 48, 135, 0.1);
        }

        /* Form focus effects */
        .form-input {
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-input:focus {
            border-color: #003087;
            box-shadow: 0 0 0 3px rgba(0, 48, 135, 0.2);
            outline: none;
        }
    </style>
</head>

<body class="font-sans bg-gray-50 text-gray-800">




@include('branding.header')

@yield('content')

@include('branding.footer')
