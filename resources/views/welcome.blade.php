@extends('branding.layouts')

@section('content')

@vite(['resources/css/app.css', 'resources/js/app.js'])
<meta charset="UTF-8">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1200, twice: true });
</script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<style>
    /* Hero Section */
    .hero-bg {
        /* background: linear-gradient(120deg, #2563eb 0%, #1e293b 100%); */
        position: relative;
        overflow: hidden;
    }
    .hero-bg::before {
        content: "";
        position: absolute;
        left: -10vw;
        top: -10vw;
        width: 120vw;
        height: 120vw;
        background: radial-gradient(circle at 60% 40%, #60a5fa 0%, transparent 70%);
        opacity: 0.7;
        z-index: 1;
    }
    .hero-wave {
        position: absolute;
        bottom: 0; left: 0; width: 100%; z-index: 2;
        pointer-events: none;
    }
    .hero-content {
        position: relative;
        z-index: 3;
    }
    .hero-btn {
        box-shadow: 0 8px 32px 0 rgba(37,99,235,0.15);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .hero-btn:hover {
        transform: translateY(-4px) scale(1.04);
        box-shadow: 0 16px 40px 0 rgba(37,99,235,0.22);
    }


/* Swiper Gallery Responsive */
    .swiper-wrapper {
        align-items: center; /* Keeps slides vertically centered within the wrapper */
    }

    /* Default styles for swiper-slide (mobile-first) */
    .swiper-slide {
        /* These values will be overridden by media queries for more precise control */
        width: 150px; /* Smallest base width for non-active slides */
        height: 120px; /* Smallest base height for non-active slides */
        display: flex;
        justify-content: center;
        align-items: center;
        transition: width 0.5s cubic-bezier(.4,2,.6,1), height 0.4s cubic-bezier(.4,2,.6,1), transform 0.4s cubic-bezier(.4,2,.6,1), filter 0.4s ease, opacity 0.4s ease;
        cursor: pointer;
        filter: grayscale(0.8) blur(1.5px) brightness(0.7); /* More subdued for distant slides */
        opacity: 0.6;
        z-index: 1; /* Default z-index for all non-active slides */
        border-radius: 1.5rem;
        flex-shrink: 0;
    }
    .swiper-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 1.5rem;
        box-shadow: 0 10px 24px rgba(0,0,0,0.18);
        transition: transform 0.4s cubic-bezier(.4,2,.6,1);
    }

    /* Active slide styles */
    .swiper-slide-active {
        width: 80vw !important; /* Start very wide on small screens */
        max-width: 420px !important; /* Cap width for active slide */
        height: 200px !important; /* Larger height for active slide */
        z-index: 10; /* Bring active slide to front */
        filter: none; /* Remove filters */
        opacity: 1;
        box-shadow: 0 20px 48px 0 rgba(37,99,235,0.25);
        background: linear-gradient(120deg, #fff 80%, #dbeafe 100%);
        transform: scale(1.05); /* Slight overall scale to make it pop */
    }
    .swiper-slide-active img {
        transform: scale(1); /* Reset image scale as parent is scaled */
        box-shadow: 0 15px 35px rgba(0,0,0,0.25);
    }

    /* Prev/Next immediate slides (one step away from active) */
    .swiper-slide-prev,
    .swiper-slide-next {
        width: 40vw !important; /* Larger previews on mobile */
        max-width: 150px !important; /* Cap width for immediate previews */
        height: 160px !important;
        filter: grayscale(0.4) blur(0.8px) brightness(0.9); /* Less aggressive filter */
        opacity: 0.85;
        z-index: 5; /* Between active and outer slides */
    }

    /* Outer prev/next slides (two steps away from active) */
    /* This targets slides like .swiper-slide-prev-2, .swiper-slide-next-2 etc. */
    /* For Swiper 11, it automatically adds classes like swiper-slide-prev, swiper-slide-prev-2, etc. */
    .swiper-slide:not(.swiper-slide-active):not(.swiper-slide-prev):not(.swiper-slide-next) {
        width: 80px !important; /* Make these even smaller */
        height: 120px !important;
        filter: grayscale(0.8) blur(1.5px) brightness(0.7); /* More subdued */
        opacity: 0.6;
        z-index: 2; /* Still above default, but below prev/next immediate */
    }


    /* Responsive adjustments for Swiper slides */
    @media (min-width: 480px) { /* Small tablets, large phones */
        .swiper-slide { width: 100px !important; height: 140px !important; }
        .swiper-slide-active { width: 420px !important; height: 260px !important; }
        .swiper-slide-prev, .swiper-slide-next { width: 180px !important; height: 200px !important; }
        .swiper-slide:not(.swiper-slide-active):not(.swiper-slide-prev):not(.swiper-slide-next) {
            width: 100px !important; height: 140px !important;
        }
    }
    @media (min-width: 768px) { /* Medium tablets, small laptops */
        .swiper-slide { width: 120px !important; height: 160px !important; }
        .swiper-slide-active { width: 550px !important; height: 350px !important; }
        .swiper-slide-prev, .swiper-slide-next { width: 220px !important; height: 270px !important; }
        .swiper-slide:not(.swiper-slide-active):not(.swiper-slide-prev):not(.swiper-slide-next) {
            width: 120px !important; height: 160px !important;
        }
    }
    @media (min-width: 1024px) { /* Desktops */
        .swiper-slide { width: 150px !important; height: 200px !important; }
        .swiper-slide-active { width: 700px !important; height: 450px !important; }
        .swiper-slide-prev, .swiper-slide-next { width: 280px !important; height: 340px !important; }
        .swiper-slide:not(.swiper-slide-active):not(.swiper-slide-prev):not(.swiper-slide-next) {
            width: 150px !important; height: 200px !important;
        }
    }
    @media (min-width: 1280px) { /* Large Desktops */
        .swiper-slide { width: 180px !important; height: 240px !important; }
        .swiper-slide-active { width: 800px !important; height: 500px !important; }
        .swiper-slide-prev, .swiper-slide-next { width: 320px !important; height: 380px !important; }
        .swiper-slide:not(.swiper-slide-active):not(.swiper-slide-prev):not(.swiper-slide-next) {
            width: 180px !important; height: 240px !important;
        }
    }


    /* Swiper Navigation (Arrows) */
    .swiper-button-next, .swiper-button-prev {
        color: #fff;
        top: 50%;
        width: 48px;
        height: 48px;
        background: #2563eb;
        border: 3px solid #fff;
        border-radius: 50%;
        transform: translateY(-50%);
        box-shadow: 0 2px 8px rgba(0,0,0,0.12);
        opacity: 0.85;
        transition: opacity 0.3s, background-color 0.3s;
    }
    .swiper-button-next:hover, .swiper-button-prev:hover {
        opacity: 1;
        background-color: #1e40af;
    }
    .swiper-button-next::after, .swiper-button-prev::after {
        font-size: 28px;
        font-weight: bold;
    }

    /* Swiper Pagination (Dots) */
    .swiper-pagination-bullet {
        background: #2563eb;
        opacity: 0.7;
        transition: background-color 0.3s, opacity 0.3s;
    }
    .swiper-pagination-bullet-active {
        background: #1e293b;
        opacity: 1;
    }

    /* Zoom Modal */
    #zoomModal { backdrop-filter: blur(6px); }

    /* Section Animation */
    .section-fade { animation: sectionFadeIn 1.2s cubic-bezier(.4,2,.6,1) both; }
    @keyframes sectionFadeIn {
        0% { opacity: 0; transform: translateX(-60px);}
        100% { opacity: 1; transform: translateX(0);}
    }
    .section-fade-right { animation: sectionFadeRight 1.2s cubic-bezier(.4,2,.6,1) both; }
    @keyframes sectionFadeRight {
        0% { opacity: 0; transform: translateX(60px);}
        100% { opacity: 1; transform: translateX(0);}
    }
    .course-row-list {
        display: flex;
        flex-direction: column;
        gap: 2.5rem;
    }
    .course-row-card {
        display: flex;
        flex-direction: column;
        background: linear-gradient(135deg, #fff 70%, #dbeafe 100%);
        border-radius: 2rem;
        box-shadow: 0 8px 32px 0 rgba(37,99,235,0.10);
        overflow: hidden;
        position: relative;
        transition: transform 0.4s cubic-bezier(.4,2,.6,1), box-shadow 0.4s;
        min-height: 320px;
    }
    @media (min-width: 900px) {
        .course-row-card {
            flex-direction: row;
            min-height: 260px;
        }
    }
    .course-row-img-wrap {
        flex: 0 0 320px;
        background: linear-gradient(120deg, #2563eb 0%, #60a5fa 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 220px;
        position: relative;
    }
    .course-row-img {
        width: 90%;
        max-width: 260px;
        height: 180px;
        object-fit: cover;
        border-radius: 1.5rem;
        box-shadow: 0 8px 32px 0 rgba(37,99,235,0.10);
        transition: transform 0.4s cubic-bezier(.4,2,.6,1);
    }
    .course-row-card:hover .course-row-img {
        transform: scale(1.08) rotate(-2deg);
    }
    .course-row-badge {
        position: absolute;
        top: 1.5rem;
        left: 1.5rem;
        background: linear-gradient(90deg, #2563eb 60%, #60a5fa 100%);
        color: #fff;
        padding: 0.5rem 1.25rem;
        border-radius: 9999px;
        font-size: 0.95rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(37,99,235,0.12);
        letter-spacing: 0.02em;
        z-index: 2;
    }
    .course-row-content {
        flex: 1;
        padding: 2.5rem 2rem 2rem 2rem;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }
    .course-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2563eb;
        margin-bottom: 1rem;
        line-height: 1.2;
    }
    .course-desc {
        color: #334155;
        font-size: 1.08rem;
        margin-bottom: 1.5rem;
        font-family: 'Myanmar 3', sans-serif;
        flex: 1;
    }
    .course-list {
        margin-bottom: 1.5rem;
        padding-left: 1.25rem;
        color: #2563eb;
        font-size: 1rem;
        font-family: 'Myanmar 3', sans-serif;
    }
    .course-link {
        align-self: flex-start;
        margin-top: auto;
        background: linear-gradient(90deg, #2563eb 60%, #60a5fa 100%);
        color: #fff;
        padding: 0.75rem 2rem;
        border-radius: 9999px;
        font-weight: 600;
        font-size: 1.08rem;
        box-shadow: 0 2px 8px rgba(37,99,235,0.12);
        transition: background 0.2s, transform 0.2s;
    }
    .course-link:hover {
        background: linear-gradient(90deg, #1e293b 60%, #2563eb 100%);
        transform: translateY(-2px) scale(1.04);
        color: #fff;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const swiper = new Swiper(".myNewSwiper", {
            slidesPerView: 'auto', // Use 'auto' to allow flexible slide widths based on CSS
            centeredSlides: true,
            centerInsufficientSlides: true,
            spaceBetween: 5, // Adjusted space between slides
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
                pauseOnMouseEnter: true
            },
            pagination: { el: ".swiper-pagination", clickable: true },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
            on: {
                init: function () {
                    // Ensures centering immediately on load
                    this.slideTo(this.activeIndex, 0, false);
                },
                resize: function() {
                    // Re-centers on window resize
                    this.slideTo(this.activeIndex, 0, false);
                },
                slideChangeTransitionEnd: function () {
                    // Ensures centering after slide transition completes
                    this.slideTo(this.activeIndex, 0, false);
                },
                touchEnd: function() {
                    // Ensures centering when user stops dragging
                    this.slideTo(this.activeIndex);
                }
            },
            // Responsive breakpoints for specific Swiper parameters if needed.
            // For controlling number of visible slides, it's often better to rely on CSS
            // widths with slidesPerView: 'auto' to let Swiper calculate.
            // However, if you explicitly want say 5 slides for a specific breakpoint,
            // you'd add:
            // breakpoints: {
            //     768: {
            //         slidesPerView: 5,
            //         spaceBetween: 20
            //     }
            // }
        });

        // Zoom image on click
        const zoomables = document.querySelectorAll(".zoomable");
        const zoomModal = document.getElementById("zoomModal");
        const zoomedImage = document.getElementById("zoomedImage");
        zoomables.forEach((img) => {
            img.addEventListener("click", () => {
                zoomedImage.src = img.src;
                zoomModal.classList.remove("hidden");
            });
        });

        // Close modal when clicking outside the image
        zoomModal.addEventListener("click", (event) => {
            if (event.target === zoomModal) {
                closeZoom();
            }
        });
    });

    function closeZoom() {
        document.getElementById("zoomModal").classList.add("hidden");
    }
</script>

<script>
    const text = "Welcome to Trade Training Institute";
    let index = 0;
    function typeEffect() {
        if (index < text.length) {
            document.getElementById("typing-text").innerHTML += text.charAt(index);
            index++;
            setTimeout(typeEffect, 70);
        }
    }
    // Only call typeEffect once the DOM is fully loaded and before images, etc.
    document.addEventListener('DOMContentLoaded', typeEffect);
</script>

<section class="hero-bg relative h-[600px] md:h-[700px] flex items-center justify-center overflow-hidden">
    <img src="{{ asset('images/main.png') }}" alt="Office" class="absolute inset-0 w-full h-full object-cover opacity-80 scale-105 transition-transform duration-10000 hover:scale-110" style="z-index:2;">
    <div class="absolute inset-0 bg-gradient-to-br from-blue-900/80 via-white-800/60 to-black-700/40" style="z-index:3;"></div>
    <svg class="hero-wave" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,192C384,203,480,245,576,240C672,235,768,181,864,176C960,171,1056,213,1152,197.3C1248,181,1344,107,1392,69.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
    <div class="hero-content relative z-10 max-w-3xl mx-auto px-6 py-16 md:py-24 text-white text-left" data-aos="fade-right">
        <h1 class="text-5xl text-white md:text-6xl font-extrabold mb-6 drop-shadow-lg tracking-tight">
            <span id="typing-text"></span>
        </h1>
        <p class="text-xl md:text-2xl mb-10 text-white font-medium" data-aos="fade-right" data-aos-delay="200">
            Empowering businesses and fostering growth in Myanmar
        </p>
        <div class="flex flex-wrap gap-6" data-aos="fade-right" data-aos-delay="400">
            <a href="#courses" class="hero-btn px-10 py-4 bg-gradient-to-r from-blue-600 to-blue-400 hover:from-blue-700 hover:to-blue-500 text-white rounded-full text-lg font-semibold shadow-lg">Our Courses</a>
            <a href="#contact" class="hero-btn px-10 py-4 bg-white/10 backdrop-blur-sm hover:bg-white/20 text-white border border-white/30 rounded-full text-lg font-semibold">Contact Us</a>
        </div>
    </div>
</section>

<div class="w-full bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 py-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="flex flex-col items-center bg-white shadow-xl hover:shadow-2xl transition-all duration-300 rounded-xl p-8 border-t-8 border-blue-600 group w-full">
                <div class="flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 mb-4 shadow-lg group-hover:bg-blue-600 group-hover:text-white transition">
                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
  <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
</svg>

                </div>
                <h5 class="text-xl font-bold text-blue-700 mb-2">နည်းပြစုဖွဲ့မှု</h5>
                <div class="w-10 h-1 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full mb-4"></div>
                <p class="text-gray-600 text-left" style="font-family:'Myanmar 3';">- ဘာသာရပ်နှင့်ဆိုင်သော ဝန်ကြီးဌာနများမှ ပညာရှင်များ
                    <br>- စီးပွား/ကူးသန်းဝန်ကြီးဌာနမှ ဘာသာရပ်ဆိုင်ရာ နည်းပြများ
                    <br>- နိုင်ငံခြားအဖွဲ့အစည်းများမှ နည်းပြများ
                    <br>- အသင်းအဖွဲ့/ကုမ္ပဏီများမှ ပညာရှင်များ</p>
            </div>
            <div class="flex flex-col items-center bg-white shadow-xl hover:shadow-2xl transition-all duration-300 rounded-xl p-8 border-t-8 border-blue-600 group w-full">
                <div class="flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 mb-4 shadow-lg group-hover:bg-blue-600 group-hover:text-white transition">
               <svg class="size-10 group-hover:fill-white"  height="200px" width="200px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 301.055 301.055" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M189.798,31.551c0-4.143-3.357-7.5-7.5-7.5h-79.453c-4.143,0-7.5,3.357-7.5,7.5v47.687c0,4.143,3.357,7.5,7.5,7.5h71.953 v21.186L102.845,179.9l-18.532-18.54c-1.571-1.571-3.769-2.362-5.97-2.168c-2.213,0.197-4.225,1.365-5.493,3.189L1.342,265.221 c-1.594,2.292-1.782,5.28-0.488,7.755c1.293,2.476,3.855,4.026,6.647,4.026h286.035c0.008,0.001,0.016,0.001,0.02,0 c4.143,0,7.5-3.357,7.5-7.5c0-1.783-0.622-3.421-1.661-4.708L189.798,108.66V31.551z M110.345,71.738V39.051h64.453v32.687H110.345z M21.85,262.003l58.195-83.694l17.495,17.503c1.407,1.406,3.315,2.197,5.305,2.197c1.989,0,3.897-0.791,5.304-2.197l73.141-73.165 l97.818,139.357H21.85z"></path> </g></svg>

                </div>
                <h5 class="text-xl font-bold text-blue-700 mb-2">ရည်ရွယ်ချက်</h5>
                <div class="w-10 h-1 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full mb-4"></div>
                <p class="text-gray-600 text-left" style="font-family:'Myanmar 3';">-အစိုးရဝန်ထမ်းများနှင့်ပုဂ္ဂလိကစီးပွားရေးလုပ်ကိုင်သူများအား ကုန်သွယ်မှုဆိုင်ရာ အသိပညာဗဟုသုတများ ရရှိစေရန်။
                    <br><br>-ကုန်သွယ်မှုနှင့်ဆိုင်သော လူ့စွမ်းအားအရင်းအမြစ်ဖွံ့ဖြိုးတိုးတက်စေရန်။</p>
            </div>
            <div class="flex flex-col items-center bg-white shadow-xl hover:shadow-2xl transition-all duration-300 rounded-xl p-8 border-t-8 border-blue-600 group w-full">
                <div class="flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 mb-4 shadow-lg group-hover:bg-blue-600 group-hover:text-white transition">
                
            <svg class="size-10 group-hover:fill-white" viewBox="0 0 1024 1024" fill="#000000" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M376.228 784.016c-4.414 0-8.078-3.578-8.078-8s3.5-8 7.922-8h0.156c4.42 0 8 3.578 8 8s-3.58 8-8 8zM440.224 720.02c-4.414 0-8.078-3.578-8.078-8s3.5-8 7.922-8h0.156c4.42 0 8 3.578 8 8s-3.58 8-8 8zM472.222 688.02c-4.414 0-8.078-3.578-8.078-7.998 0-4.422 3.5-8 7.922-8h0.156c4.42 0 8 3.578 8 8a7.998 7.998 0 0 1-8 7.998zM504.22 720.02c-4.414 0-8.078-3.578-8.078-8s3.5-8 7.922-8h0.156c4.42 0 8 3.578 8 8s-3.58 8-8 8zM504.22 656.024c-4.414 0-8.078-3.578-8.078-8s3.5-8 7.922-8h0.156c4.42 0 8 3.578 8 8s-3.58 8-8 8zM536.216 688.02c-4.406 0-8.078-3.578-8.078-7.998 0-4.422 3.5-8 7.922-8h0.156c4.422 0 8 3.578 8 8a7.994 7.994 0 0 1-8 7.998zM568.214 720.02c-4.406 0-8.078-3.578-8.078-8s3.5-8 7.922-8h0.156c4.42 0 7.998 3.578 7.998 8s-3.578 8-7.998 8zM408.226 752.016c-4.414 0-8.078-3.578-8.078-7.998 0-4.422 3.5-8 7.922-8h0.156c4.42 0 8 3.578 8 8a7.998 7.998 0 0 1-8 7.998zM440.224 784.016c-4.414 0-8.078-3.578-8.078-8s3.5-8 7.922-8h0.156c4.42 0 8 3.578 8 8s-3.58 8-8 8zM472.222 752.016c-4.414 0-8.078-3.578-8.078-7.998 0-4.422 3.5-8 7.922-8h0.156c4.42 0 8 3.578 8 8a7.998 7.998 0 0 1-8 7.998zM504.22 784.016c-4.414 0-8.078-3.578-8.078-8s3.5-8 7.922-8h0.156c4.42 0 8 3.578 8 8s-3.58 8-8 8zM536.216 752.016c-4.406 0-8.078-3.578-8.078-7.998 0-4.422 3.5-8 7.922-8h0.156c4.422 0 8 3.578 8 8a7.994 7.994 0 0 1-8 7.998zM568.214 784.016c-4.406 0-8.078-3.578-8.078-8s3.5-8 7.922-8h0.156c4.42 0 7.998 3.578 7.998 8s-3.578 8-7.998 8zM600.212 752.016c-4.406 0-8.078-3.578-8.078-7.998 0-4.422 3.5-8 7.922-8h0.156c4.422 0 8 3.578 8 8a7.994 7.994 0 0 1-8 7.998zM632.21 784.016c-4.406 0-8.078-3.578-8.078-8s3.5-8 7.922-8h0.156c4.42 0 7.998 3.578 7.998 8s-3.578 8-7.998 8zM600.212 816.012c-4.406 0-8.078-3.578-8.078-7.998 0-4.422 3.5-8 7.922-8h0.156c4.422 0 8 3.578 8 8a7.994 7.994 0 0 1-8 7.998zM664.208 816.012c-4.406 0-8.078-3.578-8.078-7.998 0-4.422 3.5-8 7.922-8h0.156c4.422 0 8 3.578 8 8a7.994 7.994 0 0 1-8 7.998z" fill=""></path><path d="M487.744 1024c-137.1 0-455.972-13.25-455.972-135.992 0-4.422 3.578-8 8-8 4.422 0 8 3.578 8 8 0 88.464 227.276 119.992 439.972 119.992 40.88 0 156.748-29.356 269.522-68.292 124.242-42.888 210.19-85.496 218.97-108.542-12.89-15.062-188.442-3.438-343.462 16.782a8 8 0 1 1-2.062-15.874c77.776-10.14 333.556-40.826 358.416-9.36 3.234 4.11 3.968 9.14 2.062 14.14C966.314 902.148 575.276 1024 487.744 1024z" fill=""></path><path d="M375.75 896.008h-111.994c-4.42 0-8-3.578-8-8s3.578-8 8-8h111.994c56.246 0 199.352-27.264 215.9-40.808-0.468-4.906-2.844-9.282-7.218-13.328-33.216-30.686-160.004-27.936-206.048-24.294a7.22 7.22 0 0 1-1.632-0.032c-2.304-0.312-231.612-28.28-306.452 37.716-15.162 13.374-22.53 29.326-22.53 48.746 0 4.422-3.578 8-8 8-4.42 0-8-3.578-8-8 0-23.952 9.406-44.386 27.952-60.746 78.682-69.356 300.45-43.872 318.214-41.684 14.42-1.11 173.338-12.094 217.336 28.542 8.282 7.624 12.468 16.672 12.468 26.89 0.004 30.124-197.124 54.998-231.99 54.998z" fill=""></path><path d="M711.736 816.012a7.95 7.95 0 0 1-5.656-2.344L498.086 605.682a8 8 0 0 1 11.312-11.31l207.994 207.986a7.996 7.996 0 0 1-5.656 13.654z" fill=""></path><path d="M343.752 768.016a8 8 0 0 1-5.656-13.656l159.99-159.988a8 8 0 0 1 11.312 11.31l-159.99 159.99a7.974 7.974 0 0 1-5.656 2.344z" fill=""></path><path d="M536.232 511.968a7.926 7.926 0 0 1-4.782-1.594 7.974 7.974 0 0 1-1.61-11.186c80.746-108.15 161.928-114.9 165.334-115.134 4.344-0.438 8.202 3.016 8.53 7.406a8.028 8.028 0 0 1-7.404 8.562c-0.766 0.046-77.636 6.952-153.646 108.728a7.994 7.994 0 0 1-6.422 3.218z" fill=""></path><path d="M649.458 511.968c-33.466 0-64.34-18.14-80.604-47.34-11.984-21.5-14.86-46.388-8.14-70.074 6.75-23.67 22.31-43.31 43.81-55.294 27.186-15.14 92.65-24.186 140.24-24.186 54.138 0 62.152 10.766 64.792 14.296 3.39 4.562 4.172 10.716 2.422 18.858-8.28 38.544-79.806 130.93-117.742 152.068a92.14 92.14 0 0 1-44.778 11.672z m95.308-180.894c-51.09 0-110.524 9.936-132.46 22.154-17.78 9.906-30.624 26.138-36.186 45.7-5.576 19.578-3.188 40.138 6.718 57.918 13.438 24.124 38.966 39.122 66.622 39.122 12.876 0 25.672-3.344 36.998-9.64 44.154-24.624 117.088-133.29 110.212-147.506-1.562-2.076-14.078-7.748-51.904-7.748z" fill=""></path><path d="M397.186 479.206c-9.624 0-18.998-1.984-27.866-5.906-30.374-13.42-103.572-92.682-96.456-116.93 3.82-13.032 29.178-19.64 75.386-19.64 25.828 0 59.584 2.704 76.854 10.312 34.81 15.406 50.616 56.232 35.256 91.042-11.052 24.982-35.848 41.122-63.174 41.122z m-48.934-126.478c-40.076 0-57.964 5.954-60.356 8.828-1.156 12.06 57.098 83.51 87.894 97.12a52.564 52.564 0 0 0 21.396 4.53c21 0 40.052-12.406 48.536-31.592 11.804-26.734-0.344-58.106-27.076-69.932-12.162-5.36-40.45-8.954-70.394-8.954z" fill=""></path><path d="M472.252 480.034a7.998 7.998 0 0 1-7.29-4.688c-28.936-63.45-88.408-61.918-88.9-61.808-3.852 0.032-8.124-3.266-8.304-7.688a8.02 8.02 0 0 1 7.68-8.312c2.774-0.078 70.73-1.936 104.086 71.182a8.01 8.01 0 0 1-3.96 10.594 8.062 8.062 0 0 1-3.312 0.72z" fill=""></path><path d="M503.376 240.486c-66.3 0-120.244-53.934-120.244-120.244S437.076 0 503.376 0c66.308 0 120.242 53.934 120.242 120.242s-53.934 120.244-120.242 120.244z m0-224.486c-57.482 0-104.244 46.762-104.244 104.244s46.762 104.244 104.244 104.244c57.464 0 104.244-46.762 104.244-104.244S560.84 16 503.376 16z" fill=""></path><path d="M503.376 272.234c-66.3 0-120.244-53.934-120.244-120.244 0-4.42 3.578-8 8-8 4.422 0 8 3.578 8 8 0 57.482 46.762 104.244 104.244 104.244 57.464 0 104.244-46.762 104.244-104.244 0-4.42 3.562-8 7.998-8 4.406 0 8 3.578 8 8 0 66.308-53.934 120.244-120.242 120.244z" fill=""></path><path d="M615.618 159.99a7.984 7.984 0 0 1-7.998-8V120.242c0-4.42 3.562-8 7.998-8 4.406 0 8 3.578 8 8v31.748c0 4.422-3.594 8-8 8zM391.132 159.99c-4.42 0-8-3.578-8-8V120.242c0-4.42 3.578-8 8-8 4.422 0 8 3.578 8 8v31.748c0 4.422-3.578 8-8 8zM503.626 175.99c-4.422 0-8-3.578-8-8V71.996c0-4.422 3.578-8 8-8 4.42 0 8 3.578 8 8v95.994a7.998 7.998 0 0 1-8 8z" fill=""></path><path d="M503.376 272.234c-4.422 0-8-3.578-8-8v-31.748c0-4.422 3.578-8 8-8s8 3.578 8 8v31.748c0 4.422-3.578 8-8 8z" fill=""></path><path d="M567.372 252.188c-4.438 0-8-3.578-8-8v-31.732c0-4.42 3.562-8 8-8a8.004 8.004 0 0 1 7.998 8v31.732c0 4.422-3.592 8-7.998 8z" fill=""></path><path d="M455.378 261.468c-4.42 0-8-3.578-8-8V221.72c0-4.422 3.578-8 8-8 4.422 0 8 3.578 8 8v31.748c0 4.422-3.578 8-8 8z" fill=""></path><path d="M504.244 576.028c-4.422 0-8-3.578-8-8V311.98c0-4.42 3.578-8 8-8 4.42 0 8 3.578 8 8v256.046a8 8 0 0 1-8 8.002z" fill=""></path><path d="M504.244 319.98a8 8 0 0 1-5.656-13.656l15.998-16a8 8 0 0 1 11.312 0 7.984 7.984 0 0 1 0 11.312l-15.998 16a7.972 7.972 0 0 1-5.656 2.344z" fill=""></path><path d="M504.244 319.98a7.976 7.976 0 0 1-5.656-2.344l-16-16a8 8 0 1 1 11.312-11.312l16 16a8 8 0 0 1-5.656 13.656z" fill=""></path></g></svg>
            
            </div>
                <h5 class="text-xl font-bold text-blue-700 mb-2">မျှော်မှန်းချက်</h5>
                <div class="w-10 h-1 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full mb-4"></div>
                <p class="text-gray-600 text-left" style="font-family:'Myanmar 3';">-ကုန်သွယ်မှု နှင့် စီးပွားရေးဆိုင်ရာ ဘာသာရပ်များ သင်ကြားပို့ချပေးသည့် နိုင်ငံတကာ အသိအမှတ်ပြု သင်တန်းကျောင်းဖြစ်ပေါ်လာစေရန်။</p>
            </div>
            <div class="flex flex-col items-center bg-white shadow-xl hover:shadow-2xl transition-all duration-300 rounded-xl p-8 border-t-8 border-blue-600 group w-full">
                <div class="flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 mb-4 shadow-lg group-hover:bg-blue-600 group-hover:text-white transition">
<svg class="size-10 group-hover:fill-white" height="200px" width="200px" version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M30.9,5.6C30.8,5.2,30.4,5,30,5h-3V2c0-0.4-0.2-0.8-0.6-0.9C26,0.9,25.6,1,25.3,1.3l-4,4C21.1,5.5,21,5.7,21,6v3.6l-5.7,5.7 c-0.4,0.4-0.4,1,0,1.4c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3l5.7-5.7H26c0.3,0,0.5-0.1,0.7-0.3l4-4C31,6.4,31.1,6,30.9,5.6z"></path> <path d="M18.1,18.1C17.6,18.7,16.8,19,16,19s-1.6-0.3-2.1-0.9c-1.2-1.2-1.2-3.1,0-4.2l2.8-2.8C16.5,11,16.2,11,16,11 c-2.8,0-5,2.2-5,5s2.2,5,5,5s5-2.2,5-5c0-0.2,0-0.5-0.1-0.7L18.1,18.1z"></path> <path d="M28.1,12.1C27.6,12.7,26.8,13,26,13h-2.8l-0.7,0.7c0.3,0.7,0.4,1.5,0.4,2.3c0,3.9-3.1,7-7,7s-7-3.1-7-7s3.1-7,7-7 c0.8,0,1.6,0.2,2.3,0.4L19,8.8V6c0-0.8,0.3-1.6,0.9-2.1l1-1C19.3,2.3,17.7,2,16,2C8.3,2,2,8.3,2,16s6.3,14,14,14s14-6.3,14-14 c0-1.7-0.3-3.3-0.9-4.9L28.1,12.1z"></path> </g></svg>
                </div>
                <h5 class="text-xl font-bold text-blue-700 mb-2">ရည်မှန်းချက်</h5>
                <div class="w-10 h-1 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full mb-4"></div>
                <p class="text-gray-600 text-left" style="font-family:'Myanmar 3';">-အစိုးရဝန်ထမ်းများနှင့် ပုဂ္ဂလိကဏ္ဍ မှလုပ်ငန်းရှင်များ ကုန်သွယ်မှုနှင့် စီးပွားရေးဆိုင်ရာ ဗဟုသုတများတိုးပွားစေရန်။
                    <br>-အရည်အသွေးမှီ သင်တန်းများ ပို့ချပေးခြင်းဖြင့် စွမ်းဆောင်ရည် မြှင့်တင်ပေး နိုင်ရန်။
                </p>
            </div>
        </div>
    </div>
</div>

<section id="galleries" class="py-24 bg-gradient-to-br from-blue-50 via-blue-100 to-blue-50 section-fade">
    <div data-aos="fade-left">
        <div class="container mx-auto text-center px-4">
            <h2 class="text-4xl md:text-5xl font-extrabold text-blue-700 mb-3 tracking-tight">Our Gallery Events</h2>
            <div class="w-24 h-1 bg-blue-600 mx-auto mb-10 rounded-full"></div>
            <div class="relative">
                <div class="swiper myNewSwiper">
                    <div class="swiper-wrapper items-center">
                        @foreach (['1.png', '2.png', '3.png', '4.png', '5.png', '6.png', '7.png', '5.png'] as $img)
                            <div class="swiper-slide" data-aos="zoom-in-up">
                                <img src="{{ asset('images/MOC/' . $img) }}" alt="Gallery Image" class="zoomable" />
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination mt-6"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="zoomModal" class="fixed inset-0 bg-black bg-opacity-80 hidden z-50 flex items-center justify-center p-4">
    <span class="absolute top-6 right-6 text-white text-4xl cursor-pointer" onclick="closeZoom()">×</span>
    <img id="zoomedImage" class="max-w-full max-h-[90vh] rounded-lg shadow-xl" src="" alt="Zoomed Image" />
</div>


<section id="courses" class="py-24 bg-gradient-to-r from-blue-50 via-blue-100 to-blue-50 section-fade-right">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-extrabold text-blue-700 mb-3 tracking-tight">Our Courses</h2>
            <div class="w-24 h-1 bg-blue-600 mx-auto mb-6 rounded-full"></div>
            <p class="text-gray-600 max-w-2xl mx-auto text-lg">Comprehensive solutions to support your business needs</p>
        </div>
        <div class="course-row-list">
            <div class="course-row-card group" data-aos="fade-right">
                <div class="course-row-img-wrap">
                    <span class="course-row-badge">2 Weeks</span>
                    <img src="{{ asset('images/Course1.png') }}" alt="SME Course" class="course-row-img">
                </div>
                <div class="course-row-content">
                    <div class="course-title">ITC ၏ SME နှင့် ပတ်သက်သည့် ကုန်သွယ်ရေးဆိုင်ရာ သင်တန်း</div>
                    <div class="course-desc">
                        ဤသင်တန်းကျောင်းတွင်တင်ပို့ကုန်လုပ်ငန်းနှင့်ဆိုင်သောဘာသာရပ်အမျိုးမျိုးအတွက်သင်တန်းများ ရှိပါသည်။
                    </div>
                    <ul class="course-list list-disc">
                        <li>ကော်ဖီတင်ပို့ခြင်းကို စတင်လေ့လာခြင်း</li>
                        <li>သင်၏ B2B စီးပွားရေးအတွက် E-Commerce လုပ်ကိုင်ခြင်း</li>
                    </ul>
                    <a href="#" class="course-link">Learn more →</a>
                </div>
            </div>
            <div class="course-row-card group" data-aos="fade-left" data-aos-delay="150">
                <div class="course-row-img-wrap">
                    <span class="course-row-badge">International</span>
                    <img src="{{ asset('images/Course2.png') }}" alt="Trade Course" class="course-row-img">
                </div>
                <div class="course-row-content">
                    <div class="course-title">ကုန်သွယ်မှုနှင့်စီးပွားရေးဆိုင်ရာရက်တိုသင်တန်းများ</div>
                    <div class="course-desc">
                        နိုင်ငံတကာနှင့်ပတ်သက်သည့် စီးပွားရေးဆိုင်ရာ အသိပညာများတိုးပွားစေရန် နိုင်ငံတကာအဖွဲ့အစည်းများနှင့် ပူးပေါင်း၍လည်းကောင်း၊ ပို့ကုန် သွင်းကုန်နှင့် ပတ်သက်သည့် ကုန်သွယ်မှုဆောင်ရွက်နိုင်ရန်အတွက်လည်းကောင်း ရည်ရွယ်ပြီးဖွင့်လှစ်ပါသည်။
                    </div>
                    <ul class="course-list list-disc">
                        <li>WTO, UNESCAP, JICA တို့နှင့်ပူးပေါင်းဖွင့်လှစ်ခြင်း</li>
                    </ul>
                    <a href="#" class="course-link">Learn more →</a>
                </div>
            </div>
            <div class="course-row-card group" data-aos="fade-right" data-aos-delay="300">
                <div class="course-row-img-wrap">
                    <span class="course-row-badge">JICA Project</span>
                    <img src="{{ asset('images/Course3.png') }}" alt="JICA Course" class="course-row-img">
                </div>
                <div class="course-row-content">
                    <div class="course-title">JICA Project Team နှင့် ပူးပေါင်းဖွင့်လှစ်သည့် သင်တန်းများ</div>
                    <div class="course-desc">
                        - JICA Project Team နှင့် ပူးပေါင်းဆောင်ရွက်မှုများ<br>
                        - First Track Project on the Capacity Development of the Trade Promotion in Myanmar<br>
                        - MOU (၂၀၁၂ ၊ ဩဂုတ် ၃၁ လက်မှတ်ရေးထိုး)<br>
                        - Project ကာလ (၁၅-၅-၂၀၂၅ မှ ၇-၇-၂၀၂၅) ထိ
                    </div>
                    <a href="#" class="course-link">Learn more →</a>
                </div>
            </div>
            </div>
    </div>
</section>

<section id="contact" class="py-24 bg-gradient-to-br from-blue-50 via-white to-blue-100 section-fade">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-extrabold text-blue-700 mb-3 tracking-tight">Contact Us</h2>
            <div class="w-24 h-1 bg-blue-600 mx-auto mb-6 rounded-full"></div>
            <p class="text-gray-600 max-w-2xl mx-auto text-lg">Get in touch with our team for any inquiries or assistance</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
            <div class="contact-card p-10 rounded-2xl shadow-md section-fade" data-aos="fade-right">
                <form class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-blue-700 mb-1">Your Name</label>
                        <input type="text" id="name" placeholder="Enter your full name" class="form-input w-full p-3 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all duration-300">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-semibold text-blue-700 mb-1">Your Email</label>
                        <input type="email" id="email" placeholder="Enter your email address" class="form-input w-full p-3 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all duration-300">
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-semibold text-blue-700 mb-1">Your Message</label>
                        <textarea id="message" rows="5" placeholder="How can we help you?" class="form-input w-full p-3 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 transition-all duration-300"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-400 text-white px-8 py-3 rounded-lg hover:from-blue-700 hover:to-blue-500 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-lg font-semibold text-lg">Send Message</button>
                </form>
            </div>
            <div class="rounded-2xl overflow-hidden shadow-lg h-[420px] section-fade-right" data-aos="fade-left">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3819.336183313063!2d96.1287955!3d16.8093863!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1ec252d6a5043%3A0x6b2b7b0e1b0b0b0!2sTrade%20Training%20Institute!5e0!3m2!1sen!2smm!4v1716358362615!5m2!1sen!2smm" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>

@endsection
