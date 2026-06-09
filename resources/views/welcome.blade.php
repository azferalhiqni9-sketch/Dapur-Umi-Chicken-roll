@extends('layouts.app')

@section('title', 'Dapur Umi Chiro - Home')

@section('content')
<!-- Hero Section dengan Background Image -->
<div class="hero-section" style="
    background-image: url('{{ asset('img/bg chicken rol.png') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 100vh;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    text-align: left;
">
    <!-- Overlay gelap agar teks lebih terbaca -->
    <div class="overlay" style="
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
    "></div>
    
    <div class="container position-relative z-index-1" style="z-index: 2;">
        <div class="col-lg-6">
            <h1 class="display-3 fw-bold text-white">
                Dapur Umi <span class="text-danger">Chiro</span>
            </h1>
            <p class="lead text-white mt-4" style="max-width: 600px;">
                Dibuat fresh setiap hari dari bahan-bahan pilihan terbaik.<br>
                Setiap gigitan menghadirkan perpaduan sempurna antara kulit crispy yang renyah<br>
                dan keju lumer yang menggoda. Cocok untuk camilan, makan siang,<br>
                maupun oleh-oleh spesial.
            </p>
            <div class="mt-5">
                <a href="{{ route('menu') }}" class="btn btn-danger btn-lg me-3 px-4 py-2">
                    <i class="fas fa-utensils me-2"></i>Lihat Menu
                </a>
                <a href="{{ route('kontak') }}" class="btn btn-outline-light btn-lg px-4 py-2">
                    <i class="fas fa-shopping-cart me-2"></i>Pesan Sekarang
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .hero-section {
        /* margin-top: -56px; */
    }
    .btn-outline-light:hover {
        background-color: #dc3545;
        border-color: #dc3545;
    }
    @media (max-width: 768px) {
        .display-3 {
            font-size: 2rem;
        }
        .lead {
            font-size: 1rem;
        }
        .btn-lg {
            font-size: 0.9rem;
            padding: 8px 16px;
        }
        .col-lg-6 {
            width: 100%;
        }
    }
</style>
@endsection