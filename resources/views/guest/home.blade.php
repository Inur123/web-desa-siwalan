@extends('guest.layouts.app')
@section('title', 'Beranda - Desa Siwalan')

@section('content')

    <style>
        html {
            scroll-behavior: smooth;
        }

        .hero-slider {
            position: relative;
            overflow: hidden;
            height: 70vh;
            min-height: 500px;
            max-height: 800px;
        }

        .slider-track {
            position: relative;
            height: 100%;
        }

        .slider-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 0.8s ease-in-out;
            pointer-events: none;
        }

        .slider-slide.active {
            opacity: 1;
            pointer-events: auto;
        }

        .slider-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.3) 50%, rgba(0, 0, 0, 0.1) 100%);
        }

        .slider-content {
            position: relative;
            z-index: 10;
            color: white;
            text-align: center;
            max-width: 56rem;
            padding: 2rem;
            margin: 0 auto;
        }

        .slider-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 20;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dot.active {
            background: white;
            width: 30px;
            border-radius: 6px;
        }

        .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 20;
            background: rgba(255, 255, 255, 0.3);
            border: none;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            transition: all 0.3s ease;
        }

        .slider-btn:hover {
            background: rgba(255, 255, 255, 0.6);
        }

        .slider-btn.prev {
            left: 20px;
        }

        .slider-btn.next {
            right: 20px;
        }

        @media (max-width: 768px) {
            .hero-slider {
                height: 60vh;
                min-height: 400px;
            }

            .slider-btn {
                width: 40px;
                height: 40px;
                font-size: 18px;
            }

            .slider-btn.prev {
                left: 10px;
            }

            .slider-btn.next {
                right: 10px;
            }
        }
    </style>


    <!-- ================= SLIDER ================= -->
    <!-- ================= STYLES ================= -->
    <style>
        html {
            scroll-behavior: smooth;
        }

        .hero-slider {
            position: relative;
            overflow: hidden;
            height: 70vh;
            min-height: 500px;
            max-height: 800px;
        }

        .slider-track {
            position: relative;
            height: 100%;
        }

        .slider-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 0.8s ease-in-out;
            pointer-events: none;
        }

        .slider-slide.active {
            opacity: 1;
            pointer-events: auto;
        }

        .slider-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.3) 50%, rgba(0, 0, 0, 0.1) 100%);
        }

        .slider-content {
            position: relative;
            z-index: 10;
            color: white;
            text-align: center;
            max-width: 56rem;
            padding: 2rem;
            margin: 0 auto;
        }

        .slider-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 20;
        }

        .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dot.active {
            background: white;
            width: 30px;
            border-radius: 6px;
        }

        .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 20;
            background: rgba(255, 255, 255, 0.3);
            border: none;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            transition: all 0.3s ease;
        }

        .slider-btn:hover {
            background: rgba(255, 255, 255, 0.6);
        }

        .slider-btn.prev {
            left: 20px;
        }

        .slider-btn.next {
            right: 20px;
        }

        @media (max-width: 768px) {
            .hero-slider {
                height: 60vh;
                min-height: 400px;
            }

            .slider-btn {
                width: 40px;
                height: 40px;
                font-size: 18px;
            }

            .slider-btn.prev {
                left: 10px;
            }

            .slider-btn.next {
                right: 10px;
            }
        }
    </style>

    <!-- ================= SLIDER ================= -->
    <section class="hero-slider" id="heroSlider">
        <div class="slider-track" id="sliderTrack">

            <div class="slider-slide active" style="background-image: url('{{ asset('images/hero-1.png') }}')">
                <div class="slider-overlay"></div>
                <div class="slider-content">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">Selamat Datang di Desa Siwalan
                    </h1>
                    <p class="text-base md:text-lg lg:text-xl mb-6 text-gray-100">
                        Membangun desa yang maju, modern, dan sejahtera untuk semua warganya
                    </p>
                    <button
                        class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-semibold transition">
                        Pelajari Lebih Lanjut
                    </button>
                </div>
            </div>

            <div class="slider-slide" style="background-image: url('{{ asset('images/hero-2.png') }}')">
                <div class="slider-overlay"></div>
                <div class="slider-content">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">Gotong Royong Membangun Masa
                        Depan</h1>
                    <p class="text-base md:text-lg lg:text-xl mb-6 text-gray-100">
                        Bersama-sama kita wujudkan desa yang lebih baik dan berkelanjutan
                    </p>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition">
                        Bergabung Sekarang
                    </button>
                </div>
            </div>

            <div class="slider-slide" style="background-image: url('{{ asset('images/hero-3.png') }}')">
                <div class="slider-overlay"></div>
                <div class="slider-content">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">Pembangunan Infrastruktur
                        Berkelanjutan</h1>
                    <p class="text-base md:text-lg lg:text-xl mb-6 text-gray-100">
                        Investasi untuk kemajuan ekonomi dan kesejahteraan warga desa
                    </p>
                    <button
                        class="bg-orange-600 hover:bg-orange-700 text-white px-8 py-3 rounded-lg font-semibold transition">
                        Lihat Proyek Kami
                    </button>
                </div>
            </div>

        </div>

        <button class="slider-btn prev" id="prevBtn">‹</button>
        <button class="slider-btn next" id="nextBtn">›</button>
        <div class="slider-dots" id="sliderDots"></div>
    </section>


    <!-- ================= SERVICES ================= -->
    <section class="py-16 px-4 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Layanan Unggulan</h2>
                <p class="text-lg text-gray-600">Layanan terpadu untuk kemudahan warga dalam mengakses administrasi desa</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                <a href="layanan.html"
                    class="card-hover bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-lg transition">
                    <div class="text-4xl mb-4">📄</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Pengajuan Surat</h3>
                    <p class="text-gray-600">Ajukan surat keterangan, izin, dan dokumen resmi desa secara online</p>
                </a>

                <a href="layanan.html"
                    class="card-hover bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-lg transition">
                    <div class="text-4xl mb-4">🆔</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">SKTM & Administrasi</h3>
                    <p class="text-gray-600">Proses cepat untuk surat keterangan tak mampu dan layanan administrasi</p>
                </a>

                <a href="layanan.html"
                    class="card-hover bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-lg transition">
                    <div class="text-4xl mb-4">🗣️</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Pengaduan & Masukan</h3>
                    <p class="text-gray-600">Sampaikan keluhan atau saran untuk perbaikan pelayanan desa</p>
                </a>

                <a href="layanan.html"
                    class="card-hover bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-lg transition">
                    <div class="text-4xl mb-4">ℹ️</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Informasi Lainnya</h3>
                    <p class="text-gray-600">Akses berbagai informasi penting tentang program dan kegiatan desa</p>
                </a>

            </div>
        </div>
    </section>

    <!-- ================= NEWS ================= -->
    <section class="py-16 px-4">
        <div class="max-w-7xl mx-auto">

            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Berita Terkini</h2>
                <p class="text-lg text-gray-600">Update terbaru dari Desa Siwalan untuk Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($posts as $post)
                    <a href="{{ route('berita.show', ['post' => $post->slug]) }}" class="block group">
                        <article
                            class="card-hover bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transform transition-transform duration-200 group-hover:scale-105">
                            @if ($post->thumbnail)
                                <img src="{{ asset('storage/' . $post->thumbnail) }}" class="w-full h-48 object-cover">
                            @else
                                <img src="/placeholder.svg?height=200&width=400" class="w-full h-48 object-cover">
                            @endif
                            <div class="p-6">
                                <span class="text-sm text-green-600 font-semibold">
                                    {{ \Carbon\Carbon::parse($post->tanggal)->translatedFormat('l, d F Y') }}
                                </span>
                                <h3 class="text-xl font-bold text-gray-900 mt-2 mb-3">{{ $post->title }}</h3>
                                <p class="text-gray-600 text-sm mb-4">
                                    {{ Str::limit(strip_tags($post->deskripsi), 100, '...') }}
                                </p>
                            </div>
                        </article>
                    </a>
                @empty
                    <p class="text-center text-gray-500 col-span-3">Belum ada berita</p>
                @endforelse
            </div>


            <div class="text-center mt-12">
                <a href="{{ route('guest.berita') }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-semibold transition inline-block">
                    Lihat Semua Berita
                </a>
            </div>

        </div>
    </section>


    <!-- ================= SCRIPT SLIDER ================= -->
    <script>
        const sliderTrack = document.getElementById('sliderTrack');
        const sliderDots = document.getElementById('sliderDots');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const slides = document.querySelectorAll('.slider-slide');

        let currentSlide = 0;
        let isTransitioning = false;

        // Create dots
        slides.forEach((_, index) => {
            const dot = document.createElement('div');
            dot.className = `dot ${index === 0 ? 'active' : ''}`;
            dot.addEventListener('click', () => goToSlide(index));
            sliderDots.appendChild(dot);
        });

        const dots = document.querySelectorAll('.dot');

        function updateSlider() {
            // Remove active class from all slides
            slides.forEach(slide => {
                slide.classList.remove('active');
            });

            // Add active class to current slide
            slides[currentSlide].classList.add('active');

            // Update dots
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide);
            });
        }

        function nextSlide() {
            if (isTransitioning) return;
            isTransitioning = true;
            currentSlide = (currentSlide + 1) % slides.length;
            updateSlider();
            setTimeout(() => {
                isTransitioning = false;
            }, 800);
        }

        function prevSlide() {
            if (isTransitioning) return;
            isTransitioning = true;
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            updateSlider();
            setTimeout(() => {
                isTransitioning = false;
            }, 800);
        }

        function goToSlide(index) {
            if (isTransitioning || index === currentSlide) return;
            isTransitioning = true;
            currentSlide = index;
            updateSlider();
            setTimeout(() => {
                isTransitioning = false;
            }, 800);
        }

        // Event listeners
        prevBtn.addEventListener('click', prevSlide);
        nextBtn.addEventListener('click', nextSlide);

        // Auto play
        let autoPlayInterval = setInterval(nextSlide, 8000);

        // Pause on hover
        sliderTrack.addEventListener('mouseenter', () => clearInterval(autoPlayInterval));
        sliderTrack.addEventListener('mouseleave', () => {
            autoPlayInterval = setInterval(nextSlide, 8000);
        });
    </script>

@endsection
