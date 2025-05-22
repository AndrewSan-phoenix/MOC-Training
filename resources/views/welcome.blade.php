@extends('branding.layouts')

@section('content')

@vite(['resources/css/app.css', 'resources/js/app.js'])
<meta charset="UTF-8">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
  AOS.init({ duration: 1200, once: true });
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
.swiper-wrapper { align-items: center; }
.swiper-slide {
  width: 60px;
  height: 100px;
  display: flex;
  justify-content: center;
  align-items: center;
  transition: width 0.5s cubic-bezier(.4,2,.6,1), height 0.4s cubic-bezier(.4,2,.6,1), transform 0.4s cubic-bezier(.4,2,.6,1);
  cursor: pointer;
  filter: grayscale(0.3) blur(0.5px) brightness(0.95);
  opacity: 0.7;
  z-index: 1;
}
.swiper-slide img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 1.5rem;
  box-shadow: 0 10px 24px rgba(0,0,0,0.18);
  transition: transform 0.4s cubic-bezier(.4,2,.6,1);
}
.swiper-slide-active {
  width: 80vw !important;
  max-width: 320px !important;
  height: 180px !important;
  z-index: 10;
  filter: none;
  opacity: 1;
  box-shadow: 0 20px 48px 0 rgba(37,99,235,0.18);
  background: linear-gradient(120deg, #fff 80%, #dbeafe 100%);
}
.swiper-slide-active img { transform: scale(1.08); }
.swiper-slide-prev,
.swiper-slide-next {
  width: 30vw !important;
  max-width: 80px !important;
  height: 100px !important;
  z-index: 2;
}
@media (min-width: 480px) {
  .swiper-slide { width: 80px !important; height: 120px !important; }
  .swiper-slide-active { width: 320px !important; height: 200px !important; max-width: 320px !important;}
  .swiper-slide-prev,
  .swiper-slide-next { width: 120px !important; height: 120px !important; max-width: 120px !important;}
}
@media (min-width: 720px) {
  .swiper-slide { width: 120px !important; height: 180px !important; }
  .swiper-slide-active { width: 420px !important; height: 260px !important; max-width: 420px !important;}
  .swiper-slide-prev,
  .swiper-slide-next { width: 160px !important; height: 180px !important; max-width: 160px !important;}
}
@media (min-width: 1024px) {
  .swiper-slide { width: 140px !important; height: 220px !important; }
  .swiper-slide-active { width: 520px !important; height: 320px !important; max-width: 520px !important;}
  .swiper-slide-prev,
  .swiper-slide-next { width: 200px !important; height: 220px !important; max-width: 200px !important;}
}
.swiper-button-next, .swiper-button-prev {
  color: #fff; top: 50%; width: 48px; height: 48px; background: #2563eb;
  border: 3px solid #fff; border-radius: 50%; transform: translateY(-50%);
  box-shadow: 0 2px 8px rgba(0,0,0,0.12);
  opacity: 0.85;
}
.swiper-button-next::after, .swiper-button-prev::after { font-size: 28px; font-weight: bold; }
.swiper-pagination-bullet { background: #2563eb; opacity: 0.7; }
.swiper-pagination-bullet-active { background: #1e293b; opacity: 1; }
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
      slidesPerView: 'auto',
      centeredSlides: true,
      centerInsufficientSlides: true,
      spaceBetween: 3,
      loop: true,
      autoplay: { delay: 3500, disableOnInteraction: false },
      pagination: { el: ".swiper-pagination", clickable: true },
      navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
      // This ensures the active slide is always centered
      on: {
        slideChange: function () {
          setTimeout(() => {
            this.slideTo(this.activeIndex, 0, false);
          }, 10);
        }
      }
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
  window.onload = typeEffect;
</script>
<!-- Animated Hero Section -->
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


<!-- Service Start -->
<div class="w-full bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 py-12">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Card 1 -->
            <div class="flex flex-col items-center bg-white shadow-xl hover:shadow-2xl transition-all duration-300 rounded-xl p-8 border-t-8 border-blue-600 group w-full">
                <div class="flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 mb-4 shadow-lg group-hover:bg-blue-600 transition">
                    <i class="fa fa-graduation-cap text-blue-600 group-hover:text-white text-3xl"></i>
                </div>
                <h5 class="text-xl font-bold text-blue-700 mb-2">နည်းပြစုဖွဲ့မှု</h5>
                <div class="w-10 h-1 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full mb-4"></div>
                <p class="text-gray-600 text-left" style="font-family:'Myanmar 3';">- ဘာသာရပ်နှင့်ဆိုင်သော ဝန်ကြီးဌာနများမှ ပညာရှင်များ
<br>- စီးပွား/ကူးသန်းဝန်ကြီးဌာနမှ ဘာသာရပ်ဆိုင်ရာ နည်းပြများ
<br>- နိုင်ငံခြားအဖွဲ့အစည်းများမှ နည်းပြများ
<br>- အသင်းအဖွဲ့/ကုမ္ပဏီများမှ ပညာရှင်များ</p>
            </div>
            <!-- Card 2 -->
            <div class="flex flex-col items-center bg-white shadow-xl hover:shadow-2xl transition-all duration-300 rounded-xl p-8 border-t-8 border-blue-600 group w-full">
                <div class="flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 mb-4 shadow-lg group-hover:bg-blue-600 transition">
                    <i class="fa fa-globe text-blue-600 group-hover:text-white text-3xl"></i>
                </div>
                <h5 class="text-xl font-bold text-blue-700 mb-2">ရည်ရွယ်ချက်</h5>
                <div class="w-10 h-1 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full mb-4"></div>
                <p class="text-gray-600 text-left" style="font-family:'Myanmar 3';">-အစိုးရဝန်ထမ်းများနှင့်ပုဂ္ဂလိကစီးပွားရေးလုပ်ကိုင်သူများအား ကုန်သွယ်မှုဆိုင်ရာ အသိပညာဗဟုသုတများ ရရှိစေရန်။

<br><br>-ကုန်သွယ်မှုနှင့်ဆိုင်သော လူ့စွမ်းအားအရင်းအမြစ်ဖွံ့ဖြိုးတိုးတက်စေရန်။</p>
            </div>
            <!-- Card 3 -->
            <div class="flex flex-col items-center bg-white shadow-xl hover:shadow-2xl transition-all duration-300 rounded-xl p-8 border-t-8 border-blue-600 group w-full">
                <div class="flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 mb-4 shadow-lg group-hover:bg-blue-600 transition">
                    <i class="fa fa-home text-blue-600 group-hover:text-white text-3xl"></i>
                </div>
                <h5 class="text-xl font-bold text-blue-700 mb-2">မျှော်မှန်းချက်</h5>
                <div class="w-10 h-1 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full mb-4"></div>
                <p class="text-gray-600 text-left" style="font-family:'Myanmar 3';">-ကုန်သွယ်မှု နှင့် စီးပွားရေးဆိုင်ရာ ဘာသာရပ်များ သင်ကြားပို့ချပေးသည့် နိုင်ငံတကာ အသိအမှတ်ပြု သင်တန်းကျောင်းဖြစ်ပေါ်လာစေရန်။</p>
            </div>
            <!-- Card 4 -->
            <div class="flex flex-col items-center bg-white shadow-xl hover:shadow-2xl transition-all duration-300 rounded-xl p-8 border-t-8 border-blue-600 group w-full">
                <div class="flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 mb-4 shadow-lg group-hover:bg-blue-600 transition">
                    <i class="fa fa-book-open text-blue-600 group-hover:text-white text-3xl"></i>
                </div>
                <h5 class="text-xl font-bold text-blue-700 mb-2">ရည်မှန်းချက်</h5>
                <div class="w-10 h-1 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full mb-4"></div>
                <p class="text-gray-600 text-left" style="font-family:'Myanmar 3';">-အစိုးရဝန်ထမ်းများနှင့် ပုဂ္ဂလိကဏ္ဍ မှလုပ်ငန်းရှင်များ ကုန်သွယ်မှုနှင့် စီးပွားရေးဆိုင်ရာ ဗဟုသုတများတိုးပွားစေရန်။
<br>-အရည်အသွေးမှီ သင်တန်းများ ပို့ချပေးခြင်းဖြင့် စွမ်းဆောင်ရည် မြှင့်တင်ပေး နိုင်ရန်။
            </div>
        </div>
    </div>
</div>
<!-- Service End -->

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

<!-- Zoom Modal -->
<div id="zoomModal" class="fixed inset-0 bg-black bg-opacity-80 hidden z-50 flex items-center justify-center">
  <span class="absolute top-6 right-6 text-white text-4xl cursor-pointer" onclick="closeZoom()">×</span>
  <img id="zoomedImage" class="max-w-full max-h-[90vh] rounded-lg shadow-xl" src="" alt="Zoomed Image" />
</div>

<!-- Animated Courses Section -->
<section id="courses" class="py-24 bg-gradient-to-r from-blue-50 via-blue-100 to-blue-50 section-fade-right">
  <div class="container mx-auto px-4">
    <div class="text-center mb-16">
      <h2 class="text-4xl md:text-5xl font-extrabold text-blue-700 mb-3 tracking-tight">Our Courses</h2>
      <div class="w-24 h-1 bg-blue-600 mx-auto mb-6 rounded-full"></div>
      <p class="text-gray-600 max-w-2xl mx-auto text-lg">Comprehensive solutions to support your business needs</p>
    </div>
    <div class="course-row-list">
      <!-- Course 1 -->
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
      <!-- Course 2 -->
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
      <!-- Course 3 -->
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
      <!-- Add more courses here if needed -->
    </div>
  </div>
</section>

<!-- Animated Contact Section -->
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
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3820.10372902078!2d96.15231927419528!3d16.771514120256843!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c1ec7fb6cffff9%3A0xd6cc55c1a9a3073f!2sTrade%20Training%20Institute!5e0!3m2!1sen!2smm!4v1747726631151!5m2!1sen!2smm" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </div>
</section>

@endsection