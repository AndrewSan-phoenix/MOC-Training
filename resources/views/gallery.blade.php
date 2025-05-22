@extends('branding.layouts')

@section('content')

@vite(['resources/css/app.css', 'resources/js/app.js'])

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<!-- SwiperJS for slider view -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<style>
    .gallery-container {
        padding: 2rem;
        max-width: 1280px;
        margin: 0 auto;
    }

    /* Masonry View */
    .masonry-container {
        column-count: 3;
        column-gap: 1rem;
    }
    .masonry-item {
        break-inside: avoid;
        margin-bottom: 1rem;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        background: #fff;
        transition: transform 0.3s, box-shadow 0.3s;
        position: relative;
    }
    .masonry-item img {
        width: 100%;
        display: block;
        object-fit: cover;
        height: 230px;
        transition: transform 0.4s;
    }
    .masonry-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
    .masonry-item:hover img {
        transform: scale(1.05);
    }
    .masonry-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.5);
        color: white;
        opacity: 0;
        transition: opacity 0.3s;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 1rem;
        text-align: center;
    }
    .masonry-item:hover .masonry-overlay {
        opacity: 1;
    }

    /* Slider View */
    .swiper {
        width: 100%;
        padding-bottom: 40px;
    }
    .swiper-slide {
        background: #fff;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        text-align: center;
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .swiper-slide img {
        width: 100%;
        height: 230px;
        object-fit: cover;
    }
    .swiper-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.5);
        color: white;
        opacity: 0;
        transition: opacity 0.3s;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 1rem;
        text-align: center;
    }
    .swiper-slide:hover .swiper-overlay {
        opacity: 1;
    }

    /* Blog View */
    .blog-container {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        justify-content: center;
    }
    .blog-card {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        overflow: hidden;
        width: 350px;
        margin-bottom: 1rem;
        display: flex;
        flex-direction: column;
    }
    .blog-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .blog-card-content {
        padding: 1rem;
        flex: 1;
    }
    .blog-card-title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }
    .blog-card-batch {
        font-size: 0.95rem;
        color: #6b7280;
        margin-bottom: 0.5rem;
    }
    .blog-card-desc {
        font-size: 0.95rem;
        color: #374151;
    }

    /* Search & Dropdown */
    .search-combo {
        position: relative;
        width: 400px;
        margin: 0 auto 2rem;
    }
    .search-combo input {
        width: 100%;
        padding: 0.75rem 2.5rem 0.75rem 2.5rem;
        border: 1px solid #ccc;
        border-radius: 0.5rem;
        font-size: 1rem;
    }
    .search-combo .fa-magnifying-glass {
        position: absolute;
        left: 0.8rem;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
        cursor: pointer;
        user-select: none;
    }
    .search-combo .fa-chevron-down {
        position: absolute;
        right: 0.8rem;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #888;
        user-select: none;
    }
    .dropdown-list {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        border: 1px solid #ddd;
        border-top: none;
        background: white;
        max-height: 200px;
        overflow-y: auto;
        border-radius: 0 0 0.5rem 0.5rem;
        z-index: 100;
        display: none;
    }
    .dropdown-list div {
        padding: 0.75rem 1rem;
        cursor: pointer;
        transition: background 0.2s;
    }
    .dropdown-list div:hover {
        background: #f1f1f1;
    }
    .dropdown-list.active {
        display: block;
    }

    @media (max-width: 900px) {
        .masonry-container { column-count: 2; }
    }
    @media (max-width: 600px) {
        .masonry-container { column-count: 1; }
        .search-combo { width: 100%; }
        .blog-card { width: 100%; }
    }
</style>

<div class="gallery-container">
    <h1 class="text-3xl font-bold text-center text-primary mb-8">Gallery</h1>

    <!-- Grid View Buttons -->
    <div class="header" id="myHeader">
        <h2 class="text-xl mb-2">Image Gallery Views</h2>
        <p class="mb-4">Choose a view:</p>
        <button class="btn active" data-view="masonry" onclick="setGalleryView('masonry')">1</button>
        <button class="btn" data-view="slider" onclick="setGalleryView('slider')">2</button>
        <button class="btn" data-view="blog" onclick="setGalleryView('blog')">3</button>
    </div>

    <!-- Combined Search + Dropdown -->
    <div class="search-combo">
        <i class="fas fa-magnifying-glass" id="searchIcon" title="Search"></i>
        <input type="text" id="searchInput" placeholder="Search by batch or description...">
        <i class="fas fa-chevron-down" id="dropdownToggle" title="Select Batch"></i>
        <div class="dropdown-list" id="dropdownList">
            <div data-value="all">All Batches</div>
            @foreach ($batches as $batch)
                @if ($batch->galleries->count())
                    <div data-value="batch-{{ $batch->id }}">{{ $batch->name }}</div>
                @endif
            @endforeach
        </div>
    </div>

    <!-- Masonry View -->
    <div id="gallery-masonry" class="masonry-container gallery-view">
        @foreach ($batches as $batch)
            @if ($batch->galleries->count())
                @foreach ($batch->galleries as $gallery)
                    <div class="masonry-item"
                        data-description="{{ strtolower($gallery->description) }}"
                        data-batch="batch-{{ $batch->id }}"
                        data-batchname="{{ strtolower($batch->name) }}">
                        <img src="{{ asset('storage/' . $gallery->file_name) }}" alt="{{ $gallery->description }}">
                        <div class="masonry-overlay">
                            <h3>{{ $gallery->description }}</h3>
                            <p>{{ $batch->name }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach
    </div>

    <!-- Slider View -->
    <div id="gallery-slider" class="gallery-view" style="display:none;">
        <div class="swiper">
            <div class="swiper-wrapper">
                @foreach ($batches as $batch)
                    @if ($batch->galleries->count())
                        @foreach ($batch->galleries as $gallery)
                            <div class="swiper-slide"
                                data-description="{{ strtolower($gallery->description) }}"
                                data-batch="batch-{{ $batch->id }}"
                                data-batchname="{{ strtolower($batch->name) }}">
                                <img src="{{ asset('storage/' . $gallery->file_name) }}" alt="{{ $gallery->description }}">
                                <div class="swiper-overlay">
                                    <h3>{{ $gallery->description }}</h3>
                                    <p>{{ $batch->name }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>

    <!-- Blog View -->
    <div id="gallery-blog" class="blog-container gallery-view" style="display:none;">
        @foreach ($batches as $batch)
            @if ($batch->galleries->count())
                @foreach ($batch->galleries as $gallery)
                    <div class="blog-card"
                        data-description="{{ strtolower($gallery->description) }}"
                        data-batch="batch-{{ $batch->id }}"
                        data-batchname="{{ strtolower($batch->name) }}">
                        <img src="{{ asset('storage/' . $gallery->file_name) }}" alt="{{ $gallery->description }}">
                        <div class="blog-card-content">
                            <div class="blog-card-title">{{ $gallery->description }}</div>
                            <div class="blog-card-batch">{{ $batch->name }}</div>
                            <div class="blog-card-desc">Batch: {{ $batch->name }}</div>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- SwiperJS for slider view -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    // Gallery view switcher
    function setGalleryView(view) {
        document.querySelectorAll('.gallery-view').forEach(el => el.style.display = 'none');
        document.getElementById('gallery-' + view).style.display = '';
        // Update active button
        var btns = document.querySelectorAll('.header .btn');
        btns.forEach(btn => btn.classList.remove('active'));
        document.querySelector('.header .btn[data-view="' + view + '"]').classList.add('active');
        // If slider, update Swiper
        if (view === 'slider' && window.gallerySwiper) {
            setTimeout(() => window.gallerySwiper.update(), 100);
        }
    }
    // Default view
    setGalleryView('masonry');

    // Swiper slider init (3 slides per view)
    window.gallerySwiper = new Swiper('.swiper', {
        slidesPerView: 3,
        spaceBetween: 30,
        loop: true,
        pagination: { el: '.swiper-pagination', clickable: true },
        navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
        breakpoints: {
            0: { slidesPerView: 1 },
            600: { slidesPerView: 2 },
            900: { slidesPerView: 3 }
        }
    });

    // Search and dropdown logic (works for all views)
    $(function () {
        let selectedBatch = 'all';

        const $searchInput = $('#searchInput');
        const $dropdownToggle = $('#dropdownToggle');
        const $dropdownList = $('#dropdownList');

        // Show/hide dropdown list
        $dropdownToggle.on('click', function () {
            $dropdownList.toggleClass('active');
        });

        // When clicking outside, close dropdown
        $(document).on('click', function (e) {
            if (!$(e.target).closest('.search-combo').length) {
                $dropdownList.removeClass('active');
            }
        });

        // Dropdown batch selection
        $dropdownList.on('click', 'div', function () {
            selectedBatch = $(this).data('value');
            if (selectedBatch === 'all') {
                $searchInput.val('');
            } else {
                $searchInput.val($(this).text());
            }
            $dropdownList.removeClass('active');
            filterGallery();
        });

        // Search icon click triggers filtering
        $('#searchIcon').on('click', filterGallery);

        // Filter on Enter key in input field
        $searchInput.on('keypress', function (e) {
            if (e.which === 13) { // Enter key
                e.preventDefault();
                filterGallery();
            }
        });

        // Live filtering as user types
        $searchInput.on('input', function () {
            selectedBatch = 'all';
            filterGallery();
        });

        function filterGallery() {
            const searchTerm = $searchInput.val().toLowerCase().trim();

            // For each view
            $('.gallery-view').each(function () {
                const $view = $(this);
                let hasVisible = false;
                $view.find('[data-description]').each(function () {
                    const $item = $(this);
                    const description = $item.data('description');
                    const batchname = $item.data('batchname');
                    const batch = $item.data('batch');
                    let show = true;

                    if (selectedBatch !== 'all' && batch !== selectedBatch) show = false;
                    if (searchTerm && !(description.includes(searchTerm) || batchname.includes(searchTerm))) show = false;

                    $item.toggle(show);
                    if (show) hasVisible = true;
                });
                $view.toggle(hasVisible);
            });

            // For slider, update Swiper after filtering
            if ($('#gallery-slider').is(':visible') && window.gallerySwiper) {
                setTimeout(() => window.gallerySwiper.update(), 100);
            }
        }

        // Initial filter on page load (show all)
        filterGallery();
    });
</script>

@endsection