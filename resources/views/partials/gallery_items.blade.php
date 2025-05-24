<!-- {{-- This partial is used to render individual gallery items for all three views.
     It is included by the main gallery.blade.php and also returned via AJAX. --}}
@foreach ($galleries as $gallery)
    {{-- Masonry Item Structure --}}
    <div class="masonry-item gallery-item masonry-view-item"
        data-description="{{ strtolower($gallery->description) }}"
        data-batchcourse="{{ strtolower(($gallery->batch->course->name ?? 'No Course') . ' - ' . $gallery->batch->name) }}">
        <img src="{{ asset('storage/' . $gallery->file_name) }}" alt="{{ $gallery->description }}" onerror="this.onerror=null;this.src='https://placehold.co/400x230/E0E0E0/333333?text=Image+Not+Found';">
        <div class="masonry-overlay">
            <h3 class="text-white">{{ $gallery->description }}</h3>
            <p>{{ $gallery->batch->course->name ?? 'No Course' }} - {{ $gallery->batch->name }}</p>
        </div>
    </div>

    {{-- Swiper Slide Structure --}}
    <div class="swiper-slide gallery-item slider-view-item"
        data-description="{{ strtolower($gallery->description) }}"
        data-batchcourse="{{ strtolower(($gallery->batch->course->name ?? 'No Course') . ' - ' . $gallery->batch->name) }}">
        <img src="{{ asset('storage/' . $gallery->file_name) }}" alt="{{ $gallery->description }}" onerror="this.onerror=null;this.src='https://placehold.co/400x230/E0E0E0/333333?text=Image+Not+Found';">
        <div class="swiper-overlay">
            <h3>{{ $gallery->description }}</h3>
            <p>{{ $gallery->batch->course->name ?? 'No Course' }} - {{ $gallery->batch->name }}</p>
        </div>
    </div>

    {{-- Blog Card Structure --}}
    <div class="blog-card gallery-item blog-view-item"
        data-description="{{ strtolower($gallery->description) }}"
        data-batchcourse="{{ strtolower(($gallery->batch->course->name ?? 'No Course') . ' - ' . $gallery->batch->name) }}">
        <img src="{{ asset('storage/' . $gallery->file_name) }}" alt="{{ $gallery->description }}" onerror="this.onerror=null;this.src='https://placehold.co/400x200/E0E0E0/333333?text=Image+Not+Found';">
        <div class="blog-card-content">
            <div class="blog-card-title">{{ $gallery->description }}</div>
            <div class="blog-card-batch">{{ $gallery->batch->course->name ?? 'No Course' }} - {{ $gallery->batch->name }}</div>
            <div class="blog-card-desc">Batch: {{ $gallery->batch->name }}<br>Course: {{ $gallery->batch->course->name ?? '-' }}</div>
        </div>
    </div>
@endforeach -->
