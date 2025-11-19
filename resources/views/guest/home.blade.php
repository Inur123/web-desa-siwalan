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
            display: flex;
            transition: transform 0.8s ease-in-out;
            height: 100%;
        }

        .slider-slide {
            min-width: 100%;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
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

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
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

            <div class="slider-slide" style="background-image: url('{{ asset('images/hero-1.png') }}')">
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

                <article class="card-hover bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <img src="/images/hero-1.png" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="text-sm text-green-600 font-semibold">Kamis, 19 Desember 2024</span>
                        <h3 class="text-xl font-bold text-gray-900 mt-2 mb-3">Acara Pertemuan Warga Desa Siwalan</h3>
                        <p class="text-gray-600 text-sm mb-4">Lebih dari 200 warga menghadiri pertemuan membahas program
                            pembangunan tahun depan...</p>
                        <a href="detail-berita.html" class="text-green-600 font-semibold hover:text-green-700">Baca
                            Selengkapnya →</a>
                    </div>
                </article>

                <article class="card-hover bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <img src="/placeholder.svg?height=200&width=400" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="text-sm text-green-600 font-semibold">Senin, 15 Desember 2024</span>
                        <h3 class="text-xl font-bold text-gray-900 mt-2 mb-3">Pembangunan Jalan Desa Fase II</h3>
                        <p class="text-gray-600 text-sm mb-4">Pemerintah desa meresmikan dimulainya fase kedua pembangunan
                            infrastruktur jalan utama...</p>
                        <a href="detail-berita.html" class="text-green-600 font-semibold hover:text-green-700">Baca
                            Selengkapnya →</a>
                    </div>
                </article>

                <article class="card-hover bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <img src="/placeholder.svg?height=200&width=400" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="text-sm text-green-600 font-semibold">Jumat, 10 Desember 2024</span>
                        <h3 class="text-xl font-bold text-gray-900 mt-2 mb-3">Program Kesehatan Gratis</h3>
                        <p class="text-gray-600 text-sm mb-4">Desa Siwalan mengadakan pemeriksaan kesehatan rutin dan
                            penyuluhan gaya hidup sehat...</p>
                        <a href="detail-berita.html" class="text-green-600 font-semibold hover:text-green-700">Baca
                            Selengkapnya →</a>
                    </div>
                </article>

            </div>

            <div class="text-center mt-12">
                <a href="berita.html"
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

        slides.forEach((_, index) => {
            const dot = document.createElement('div');
            dot.className = `dot ${index === 0 ? 'active' : ''}`;
            dot.addEventListener('click', () => goToSlide(index));
            sliderDots.appendChild(dot);
        });

        const dots = document.querySelectorAll('.dot');

        function updateSlider() {
            sliderTrack.style.transform = `translateX(-${currentSlide * 100}%)`;
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
            if (isTransitioning) return;
            isTransitioning = true;
            currentSlide = index;
            updateSlider();
            setTimeout(() => {
                isTransitioning = false;
            }, 800);
        }

        prevBtn.addEventListener('click', prevSlide);
        nextBtn.addEventListener('click', nextSlide);

        let autoPlayInterval = setInterval(nextSlide, 8000);
        sliderTrack.addEventListener('mouseenter', () => clearInterval(autoPlayInterval));
        sliderTrack.addEventListener('mouseleave', () => {
            autoPlayInterval = setInterval(nextSlide, 8000);
        });
    </script>

@endsection
