@extends('layouts.app')

@section('title', $book->title . ' - PDF Viewer')

@section('content')
<!-- Navigation Bar -->
<div class="fixed top-0 left-0 right-0 bg-[#37709F] text-white z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="h-16 flex items-center justify-between">
            <!-- Left Side -->
            <div class="flex items-center space-x-6">
                <a href="{{ route('study.book.detail', $book->id) }}" 
                   class="group inline-flex items-center px-4 py-2 rounded-lg hover:bg-white/10 transition-all duration-200 ease-in-out">
                    <svg class="h-5 w-5 mr-2 transform transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span class="hidden sm:inline">Kembali</span>
                </a>
                <div class="flex items-center space-x-3">
                    <svg class="h-6 w-6 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <h1 class="text-lg font-medium truncate max-w-[200px] sm:max-w-md">
                        {{ $book->title }}
                    </h1>
                </div>
            </div>

            <!-- Right Side -->
            <div class="flex items-center space-x-4">
                <a href="{{ Storage::url($book->pdf_path) }}" 
                   target="_blank"
                   download="{{ $book->title }}.pdf"
                   class="inline-flex items-center px-3 py-2 bg-white/10 rounded-lg hover:bg-white/20 transition-all duration-200 active:bg-white/30">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    <span class="hidden sm:inline ml-2">Download PDF</span>
                </a>
                <div class="hidden sm:flex items-center space-x-2 text-sm text-white/80">
                    <span>Kelas {{ $book->grade }}</span>
                    <span>•</span>
                    <span>{{ $book->curriculum }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PDF Container -->
<div class="max-h-screen bg-gray-100">
    <div class="h-[calc(100vh-4rem)] bg-gray-900">
        <iframe 
            src="{{ Storage::disk('public')->url($book->pdf_path) }}"
            class="w-full h-full border-0"
            id="pdf-viewer"
            title="{{ $book->title }} PDF"
            frameborder="0"
            allowfullscreen="true">
        </iframe>
    </div>
</div>

<!-- Mobile Info Bar -->
{{-- <div class="fixed bottom-0 left-0 right-0 sm:hidden bg-[#37709F] text-white py-2 px-4 z-50">
    <div class="flex justify-between items-center">
        <span class="text-xs">Kelas {{ $book->grade }} • {{ $book->curriculum }}</span>
        <a href="{{ Storage::url($book->pdf_path) }}" 
           target="_blank"
           download="{{ $book->title }}.pdf"
           onclick="event.preventDefault(); window.open(this.href, '_blank');"
           class="inline-flex items-center px-3 py-1.5 bg-white/10 rounded-lg hover:bg-white/20 active:bg-white/30 transition-all duration-200 text-xs">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
            <span class="ml-1">Download</span>
        </a>
    </div>
</div> --}}

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const pdfViewer = document.getElementById('pdf-viewer');
    
    // Handle fullscreen
    document.addEventListener('keydown', function(e) {
        if (e.key === 'f' || e.key === 'F') {
            if (document.fullscreenElement) {
                document.exitFullscreen();
            } else {
                pdfViewer.requestFullscreen();
            }
        }
    });

    // Handle mobile download
    const downloadButtons = document.querySelectorAll('a[download]');
    downloadButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
            if (isMobile) {
                e.preventDefault();
                window.open(this.href, '_blank');
            }
        });
    });
});
</script>
@endpush

@endsection 