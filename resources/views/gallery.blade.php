@extends('branding.layouts')

@section('content')

@vite(['resources/css/app.css', 'resources/js/app.js'])

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


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
        padding:0;
        margin:0;
        border:solid 7px #555;
        max-width:600px;
        margin:40px auto;
        box-shadow:-3px -3px 12px #999;
    }

    #border{
        position:relative;
        padding:0;
        margin:0;
        border:solid 10px white;
        box-shadow:-3px -3px 12px #999;
    }

    .masonry-item img {
        padding:0;
        margin:0;
        width:100%;
        height: auto;
        border-top:solid 2px #aaa;
        border-left:solid 2px #aaa;
        border-bottom:solid 2px #ccc;
        border-right:solid 2px #ccc;
        object-fit: cover;
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
        opacity: 1;
        transition: opacity 0.3s, transform 0.3s;
    }
    .swiper-slide.filtered-out {
        opacity: 0;
        width: 0 !important;
        margin-right: 0 !important;
        transform: scale(0.8);
        pointer-events: none;
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

    /* Blog View - 4 Columns */
    .blog-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        justify-content: center;
        max-width: 1200px;
        margin: 0 auto;
    }
    .blog-card {
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        overflow: hidden;
        width: 100%;
        max-width: 350px;
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
    .gallery-view {
        display: none;
    }
    .gallery-view.active {
        display: block;
    }

    /* Load More Button */
    #loadMoreBtn {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 50px;
        height: 50px;
        background-color: #555; /* Example blue color */
        color: white;
        border-radius: 50%;
        font-size: 1.5rem;
        cursor: pointer;
        margin: 2rem auto;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        transition: background-color 0.3s, transform 0.3s;
    }

    #loadMoreBtn:hover {
        background-color: #000; /* Darker blue on hover */
        transform: translateY(-2px);
    }

    #loadMoreBtn.loading {
        background-color: #6c757d; /* Grey when loading */
        cursor: not-allowed;
    }


    @media (max-width: 1200px) {
        .blog-container { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 900px) {
        .masonry-container { column-count: 2; }
        .blog-container { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 600px) {
        .masonry-container { column-count: 1; }
        .search-combo { width: 100%; }
        .blog-card { width: 100%; max-width: 100%; }
        .blog-container { grid-template-columns: 1fr; }
    }

    /* Loading Indicator - for the initial load/after button click */
    .loading-text {
        text-align: center;
        padding: 1rem;
        display: none;
    }
</style>

<div class="gallery-container">
    <h1 class="text-3xl font-bold text-center text-primary mb-8">Gallery</h1>

    <div class="header" id="myHeader">
        <h2 class="text-xl mb-2">Image Gallery Views</h2>
        <p class="mb-4">Choose a view:</p>
        <button class="btn active" data-view="masonry" style="cursor:pointer;"><svg class="w-5" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" enable-background="new 0 0 32 32" xml:space="preserve" fill="#ffffff" stroke="#ffffff" stroke-width="2.9"><g id="SVGRepo_bgCarrier" stroke-width="2.9"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path fill="#ffffff" d="M30.208,0H1.792C0.804,0,0,0.804,0,1.792v28.416C0,31.196,0.804,32,1.792,32h28.417 C31.196,32,32,31.196,32,30.208V1.792C32,0.804,31.196,0,30.208,0z M21,1v15H11V1H21z M1.792,31C1.355,31,1,30.645,1,30.208V1.792 C1,1.355,1.355,1,1.792,1H10v30H1.792z M11,31V17h10v14H11z M31,30.208C31,30.645,30.645,31,30.208,31H22V1h8.208 C30.645,1,31,1.355,31,1.792V30.208z"></path> </g> </g></svg></button>
        <button class="btn" data-view="slider" style="cursor:pointer;"><svg class="w-5" version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32.00 32.00" xml:space="preserve" fill="##ffffff" stroke="##ffffff"><g id="SVGRepo_bgCarrier" stroke-width="3.9"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:none;stroke:#fff;stroke-width:3.9;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;} </style> <polyline class="st0" points="25,11 27,13 25,15 "></polyline> <polyline class="st0" points="7,11 5,13 7,15 "></polyline> <path class="st0" d="M29,23H3c-1.1,0-2-0.9-2-2V5c0-1.1,0.9-2,2-2h26c1.1,0,2,0.9,2,2v16C31,22.1,30.1,23,29,23z"></path> <circle class="st0" cx="16" cy="28" r="1"></circle> <circle class="st0" cx="10" cy="28" r="1"></circle> <circle class="st0" cx="22" cy="28" r="1"></circle> </g></svg></button>
        <button class="btn" data-view="blog" style="cursor:pointer;"><svg class="w-5" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" enable-background="new 0 0 32 32" xml:space="preserve" fill="#fff" stroke="#fff"><g id="SVGRepo_bgCarrier" stroke-width="2.9"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path fill="#fff" d="M30.5,0h-29C0.673,0,0,0.673,0,1.5v8C0,10.327,0.673,11,1.5,11h29c0.827,0,1.5-0.673,1.5-1.5v-8 C32,0.673,31.327,0,30.5,0z M31,9.5c0,0.275-0.225,0.5-0.5,0.5h-29C1.225,10,1,9.775,1,9.5v-8C1,1.225,1.225,1,1.5,1h29 C30.775,1,31,1.225,31,1.5V9.5z"></path> <path fill="#fff" d="M31.5,12.5c-0.276,0-0.5,0.224-0.5,0.5v17.5c0,0.275-0.225,0.5-0.5,0.5h-29C1.225,31,1,30.775,1,30.5V13 c0-0.276-0.224-0.5-0.5-0.5S0,12.724,0,13v17.5C0,31.327,0.673,32,1.5,32h29c0.827,0,1.5-0.673,1.5-1.5V13 C32,12.724,31.776,12.5,31.5,12.5z"></path> <path fill="#808184" d="M13.5,27c0.827,0,1.5-0.673,1.5-1.5v-8c0-0.827-0.673-1.5-1.5-1.5h-8C4.673,16,4,16.673,4,17.5v8 C4,26.327,4.673,27,5.5,27H13.5z M5,25.5v-8C5,17.225,5.225,17,5.5,17h8c0.275,0,0.5,0.225,0.5,0.5v8c0,0.275-0.225,0.5-0.5,0.5h-8 C5.225,26,5,25.775,5,25.5z"></path> <path fill="#808184" d="M18,18h9c0.276,0,0.5-0.224,0.5-0.5S27.276,17,27,17h-9c-0.276,0-0.5,0.224-0.5,0.5S17.724,18,18,18z"></path> <path fill="#fff" d="M18,22h9c0.276,0,0.5-0.224,0.5-0.5S27.276,21,27,21h-9c-0.276,0-0.5,0.224-0.5,0.5S17.724,22,18,22z"></path> <path fill="#808184" d="M18,26h9c0.276,0,0.5-0.224,0.5-0.5S27.276,25,27,25h-9c-0.276,0-0.5,0.224-0.5,0.5S17.724,26,18,26z"></path> </g> </g></svg></button>
    </div>

    <div class="search-combo">
        <i class="fas fa-magnifying-glass" id="searchIcon" title="Search"></i>
        <input type="text" id="searchInput" placeholder="Search by batch, course, or description...">
        <i class="fas fa-chevron-down" id="dropdownToggle" title="Select Batch"></i>
        <div class="dropdown-list" id="dropdownList">
            <div data-value="all" class="text-left">All Batches</div>
            @foreach ($batches as $batch)
                @if ($batch->galleries->count() > 0) {{-- Only show batches that actually have galleries --}}
                    <div data-value="{{ strtolower(($batch->course->name ?? 'No Course') . ' - ' . $batch->name) }}" class="text-left">
                        {{ $batch->course->name ?? 'No Course' }} - {{ $batch->name }}
                    </div>
                @endif
            @endforeach
        </div>
    </div>

    <div id="gallery-masonry" class="masonry-container gallery-view active">
        {{-- Initial galleries loaded by Laravel are here --}}
        @foreach ($galleries as $gallery)
            <div class="masonry-item gallery-item"
                data-description="{{ strtolower($gallery->description) }}"
                data-batchcourse="{{ strtolower(($gallery->batch->course->name ?? 'No Course') . ' - ' . ($gallery->batch->name ?? 'No Batch')) }}">
                <div id="border">
                    <img class="map" src="{{ asset('storage/' . $gallery->file_name) }}" alt="{{ $gallery->description }}">
                    <div class="masonry-overlay">
                        <h3 class="text-white">{{ $gallery->description }}</h3>
                        <p>{{ $gallery->batch->course->name ?? 'No Course' }} - {{ $gallery->batch->name ?? 'No Batch' }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div id="gallery-slider" class="gallery-view">
        <div class="swiper">
            <div class="swiper-wrapper">
                {{-- Swiper slides will be populated by JS for filtering, or initially from Laravel --}}
                @foreach ($galleries as $gallery)
                    <div class="swiper-slide gallery-item"
                        data-description="{{ strtolower($gallery->description) }}"
                        data-batchcourse="{{ strtolower(($gallery->batch->course->name ?? 'No Course') . ' - ' . ($gallery->batch->name ?? 'No Batch')) }}">
                        <img src="{{ asset('storage/' . $gallery->file_name) }}" alt="{{ $gallery->description }}">
                        <div class="swiper-overlay">
                            <h3>{{ $gallery->description }}</h3>
                            <p>{{ $gallery->batch->course->name ?? 'No Course' }} - {{ $gallery->batch->name ?? 'No Batch' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>

    <div id="gallery-blog" class="gallery-view">
        <div class="blog-container">
            {{-- Blog cards will be populated by JS for filtering, or initially from Laravel --}}
            @foreach ($galleries as $gallery)
                <div class="blog-card gallery-item"
                    data-description="{{ strtolower($gallery->description) }}"
                    data-batchcourse="{{ strtolower(($gallery->batch->course->name ?? 'No Course') . ' - ' . ($gallery->batch->name ?? 'No Batch')) }}">
                    <img src="{{ asset('storage/' . $gallery->file_name) }}" alt="{{ $gallery->description }}">
                    <div class="blog-card-content">
                        <div class="blog-card-title">{{ $gallery->description }}</div>
                        <div class="blog-card-batch">{{ $gallery->batch->course->name ?? 'No Course' }} - {{ $gallery->batch->name ?? 'No Batch' }}</div>
                        <div class="blog-card-desc">Batch: {{ $gallery->batch->name ?? '-' }}<br>Course: {{ $gallery->batch->course->name ?? '-' }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Load More Button --}}
    <div id="loadMoreBtn" class="flex items-center justify-center" title="Load More Images">
        <i class="fas fa-chevron-down"></i>
    </div>
    <div class="loading-text" id="loading"></div>
</div>


<script>
    let page = {{ $galleries->currentPage() }}; // Initialize page with current page from Laravel pagination
    let lastPage = {{ $galleries->lastPage() }}; // Get the last page from Laravel pagination
    let loading = false;
    let currentView = 'masonry';
    let selectedBatch = 'all';
    let gallerySwiper;
    let lastPageReached = (page >= lastPage); // Set initial lastPageReached based on Laravel pagination

    // Function to initialize or reinitialize Swiper
    function initSwiper() {
        if (gallerySwiper) {
            gallerySwiper.destroy(true, true); // Destroy existing instance
        }
        gallerySwiper = new Swiper('.swiper', {
            slidesPerView: 3,
            spaceBetween: 30,
            loop: false, // Set loop to false when filtering
            pagination: { el: '.swiper-pagination', clickable: true },
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
            breakpoints: {
                0: { slidesPerView: 1 },
                600: { slidesPerView: 2 },
                900: { slidesPerView: 3 }
            },
            observer: true, // Enable observer to react to DOM changes
            observeParents: true, // Enable observeParents to react to parent DOM changes
            on: {
                init: function () {
                    this.update(); // Update Swiper after initialization
                },
                resize: function () {
                    this.update(); // Update Swiper on window resize
                },
                slideChange: function() {
                    if (this.slides[this.activeIndex] && $(this.slides[this.activeIndex]).hasClass('filtered-out')) {
                        const visibleSlides = this.slides.filter(slide => !$(slide).hasClass('filtered-out'));
                        if (visibleSlides.length > 0) {
                            const firstVisibleIndex = this.slides.indexOf(visibleSlides[0]);
                            this.slideTo(firstVisibleIndex);
                        } else {
                            this.slideTo(0);
                        }
                    }
                }
            }
        });
    }

    // Function to set the active gallery view
    function setGalleryView(view) {
        // Remove 'active' from all views
        $('.gallery-view').removeClass('active');
        // Add 'active' to the selected view
        $('#gallery-' + view).addClass('active');
        currentView = view;

        // Update active button styling
        $('.header .btn').removeClass('active');
        $('.header .btn[data-view="' + view + '"]').addClass('active');

        // Reinitialize Swiper if switching to slider view
        if (view === 'slider') {
            setTimeout(initSwiper, 100);
        } else {
            if (gallerySwiper) {
                gallerySwiper.destroy(true, true);
                gallerySwiper = null; // Clear the reference
            }
        }
        filterGallery(); // Always re-apply filters when changing views
    }

    // Function to filter gallery items based on search term and selected batch
    function filterGallery() {
        const searchTerm = $('#searchInput').val().toLowerCase().trim();

        $('.gallery-item').each(function () {
            const $item = $(this);
            const description = $item.data('description') || '';
            const batchcourse = $item.data('batchcourse') || '';

            let matchesBatch = (selectedBatch === 'all' || batchcourse === selectedBatch);
            let matchesSearch = (!searchTerm || description.includes(searchTerm) || batchcourse.includes(searchTerm));

            if (matchesBatch && matchesSearch) {
                if ($item.hasClass('masonry-item') || $item.hasClass('blog-card')) {
                    $item.show();
                } else if ($item.hasClass('swiper-slide')) {
                    $item.removeClass('filtered-out');
                }
            } else {
                if ($item.hasClass('masonry-item') || $item.hasClass('blog-card')) {
                    $item.hide();
                } else if ($item.hasClass('swiper-slide')) {
                    $item.addClass('filtered-out');
                }
            }
        });

        if (currentView === 'slider' && gallerySwiper) {
            gallerySwiper.update();
            const activeSlide = gallerySwiper.slides[gallerySwiper.activeIndex];
            if (activeSlide && $(activeSlide).hasClass('filtered-out')) {
                const firstVisibleSlideIndex = gallerySwiper.slides.findIndex(slide => !$(slide).hasClass('filtered-out'));
                if (firstVisibleSlideIndex !== -1) {
                    gallerySwiper.slideTo(firstVisibleIndex);
                } else {
                    gallerySwiper.slideTo(0);
                }
            }
        }
    }

    // Function to load more galleries via AJAX
    function loadGalleries() {
        if (loading || lastPageReached) return; // Prevent multiple loads or loading past the last page
        loading = true;
        $('#loading').show();
        $('#loadMoreBtn').addClass('loading').find('i').removeClass('fa-chevron-down').addClass('fa-spinner fa-spin'); // Show spinner

        $.ajax({
            url: '{{ route("gallery_index") }}',
            data: { page: page + 1 }, // Request the next page
            success: function(response) {
                if (response.data && response.data.length > 0) {
                    response.data.forEach(gallery => {
                        const batchCourse = (gallery.batch && gallery.batch.course ? gallery.batch.course.name : 'No Course') + ' - ' + (gallery.batch ? gallery.batch.name : 'No Batch');
                        const lowerCaseDescription = gallery.description ? gallery.description.toLowerCase() : '';
                        const lowerCaseBatchCourse = batchCourse.toLowerCase();

                        // Create elements for all views, then filter will handle visibility
                        const masonryItem = `
                            <div class="masonry-item gallery-item" id="frame"
                                data-description="${lowerCaseDescription}"
                                data-batchcourse="${lowerCaseBatchCourse}">
                                <div id="border">
                                    <img class="map" src="{{ asset('storage/') }}/${gallery.file_name}" alt="${gallery.description}">
                                    <div class="masonry-overlay">
                                        <h3 class="text-white">${gallery.description}</h3>
                                        <p>${batchCourse}</p>
                                    </div>
                                </div>
                            </div>
                        `;
                        $('#gallery-masonry').append(masonryItem);

                        const swiperSlide = `
                            <div class="swiper-slide gallery-item"
                                data-description="${lowerCaseDescription}"
                                data-batchcourse="${lowerCaseBatchCourse}">
                                <img src="{{ asset('storage/') }}/${gallery.file_name}" alt="${gallery.description}">
                                <div class="swiper-overlay">
                                    <h3>${gallery.description}</h3>
                                    <p>${batchCourse}</p>
                                </div>
                            </div>
                        `;
                        $('#gallery-slider .swiper-wrapper').append(swiperSlide);

                        const blogCard = `
                            <div class="blog-card gallery-item"
                                data-description="${lowerCaseDescription}"
                                data-batchcourse="${lowerCaseBatchCourse}">
                                <img src="{{ asset('storage/') }}/${gallery.file_name}" alt="${gallery.description}">
                                <div class="blog-card-content">
                                    <div class="blog-card-title">${gallery.description}</div>
                                    <div class="blog-card-batch">${batchCourse}</div>
                                    <div class="blog-card-desc">Batch: ${gallery.batch ? gallery.batch.name : '-'}<br>Course: ${gallery.batch && gallery.batch.course ? gallery.batch.course.name : '-'}</div>
                                </div>
                            </div>
                        `;
                        $('#gallery-blog .blog-container').append(blogCard);
                    });
                    page = response.current_page; // Update current page
                    lastPage = response.last_page; // Update last page
                    filterGallery(); // Re-filter after new items are added

                    if (page >= lastPage) { // Check if it's the last page
                        lastPageReached = true;
                        $('#loadMoreBtn').hide(); // Hide button if no more pages
                    }
                } else {
                    lastPageReached = true;
                    $('#loadMoreBtn').hide(); // Hide button if no more items are returned
                }
            },
            complete: function() {
                loading = false;
                $('#loading').hide();
                $('#loadMoreBtn').removeClass('loading').find('i').removeClass('fa-spinner fa-spin').addClass('fa-chevron-down'); // Reset button icon
            },
            error: function(xhr, status, error) {
                console.error("Error loading galleries:", status, error);
                loading = false;
                $('#loading').hide();
                $('#loadMoreBtn').removeClass('loading').find('i').removeClass('fa-spinner fa-spin').addClass('fa-chevron-down'); // Reset button icon
            }
        });
    }

    $(function () {
        const $searchInput = $('#searchInput');
        const $dropdownToggle = $('#dropdownToggle');
        const $dropdownList = $('#dropdownList');
        const $viewButtons = $('.header .btn');
        const $loadMoreBtn = $('#loadMoreBtn');

        // Event listeners for view buttons
        $viewButtons.on('click', function() {
            setGalleryView($(this).data('view'));
        });

        // Toggle dropdown list visibility
        $dropdownToggle.on('click', function () {
            $dropdownList.toggleClass('active');
        });

        // Hide dropdown if clicked outside
        $(document).on('click', function (e) {
            if (!$(e.target).closest('.search-combo').length) {
                $dropdownList.removeClass('active');
            }
        });

        // Handle dropdown item selection
        $dropdownList.on('click', 'div', function () {
            selectedBatch = $(this).data('value');
            if (selectedBatch === 'all') {
                $searchInput.val(''); // Clear search input when "All Batches" is chosen
            } else {
                $searchInput.val($(this).text().trim()); // Set search input to selected batch
            }
            $dropdownList.removeClass('active');
            filterGallery(); // Apply filter immediately
        });

        // Trigger filter on search icon click
        $('#searchIcon').on('click', filterGallery);

        // Trigger filter on Enter key press in search input
        $searchInput.on('keypress', function (e) {
            if (e.which === 13) {
                e.preventDefault(); // Prevent form submission
                filterGallery();
            }
        });

        // Trigger filter on input changes in search bar (live search)
        $searchInput.on('input', function () {
            selectedBatch = 'all'; // Reset batch selection when typing in search bar
            filterGallery();
        });

        // Load more galleries on button click
        $loadMoreBtn.on('click', function() {
            loadGalleries();
        });

        // Initial setup on page load
        setGalleryView('masonry'); // Ensure masonry is the default view on load

        // Hide load more button if all data is already loaded initially
        if (lastPageReached) {
            $('#loadMoreBtn').hide();
        }
    });
</script>

@endsection