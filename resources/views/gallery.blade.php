@extends('branding.layouts')

@section('content')

@vite(['resources/css/app.css', 'resources/js/app.js'])

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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
        <button class="btn active" data-view="masonry">1</button>
        <button class="btn" data-view="slider">2</button>
        <button class="btn" data-view="blog">3</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

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