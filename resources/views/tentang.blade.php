@extends('layouts.app')

@section('title', 'Tentang Kami - Dapur Umi Chiro')

@section('content')
<style>
    .about-hero {
        background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('img/tentang kami.png') }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
    
    .about-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        padding: 50px 40px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.2);
        border: none;
    }
    
    .about-title {
        color: #D32F2F;
        font-weight: bold;
        font-size: 2.8rem;
        margin-bottom: 30px;
        position: relative;
        display: inline-block;
    }
    
    .about-title:after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #D32F2F, #FFC107);
        border-radius: 2px;
    }
    
    .about-text {
        color: #444;
        line-height: 1.8;
        font-size: 1.05rem;
        text-align: justify;
    }
    
    .about-text.lead {
        font-size: 1.2rem;
        color: #D32F2F;
        font-weight: 500;
        text-align: center;
    }
    
    .menu-badge {
        background: linear-gradient(135deg, #D32F2F, #FF5722);
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        display: inline-block;
        margin: 5px;
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    .btn-order {
        background: linear-gradient(135deg, #D32F2F, #FF5722);
        border: none;
        padding: 12px 35px;
        border-radius: 50px;
        font-weight: bold;
        font-size: 1.1rem;
        margin-top: 20px;
        transition: transform 0.3s ease;
    }
    
    .btn-order:hover {
        transform: translateY(-3px);
        color: white;
        background: linear-gradient(135deg, #C62828, #E64A19);
    }
    
    @media (max-width: 768px) {
        .about-card {
            padding: 30px 20px;
        }
        .about-title {
            font-size: 2rem;
        }
    }
</style>

<div class="about-hero">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="about-card">
                    <div class="text-center">
                        <h1 class="about-title">Tentang Dapur Umi Chiro</h1>
                    </div>
                    
                    <p class="about-text lead">
                        Dapur Umi merupakan usaha kuliner yang menghadirkan berbagai pilihan makanan dan minuman favorit dengan cita rasa lezat, bahan berkualitas, serta harga yang terjangkau untuk semua kalangan.
                    </p>
                    
                    <div class="text-center my-4">
                        <span class="menu-badge">🍗 Chiro (Chicken Roll)</span>
                        <span class="menu-badge">🌭 Corndog</span>
                        <span class="menu-badge">🍢 Hotang</span>
                        <span class="menu-badge">🍖 Sosis Bakar</span>
                        <span class="menu-badge">🧀 Mac & Cheese</span>
                        <span class="menu-badge">🍵 Matcha</span>
                        <span class="menu-badge">🧋 Es Teh Manis</span>
                    </div>
                    
                    <p class="about-text">
                        Kami percaya bahwa makanan yang enak bukan hanya tentang rasa, tetapi juga tentang pengalaman. Karena itu, Dapur Umi selalu berkomitmen memberikan pelayanan terbaik dan menghadirkan menu yang cocok dinikmati bersama keluarga, teman, maupun sebagai camilan favorit di berbagai suasana.
                    </p>
                    
                    <p class="about-text">
                        Dengan perpaduan rasa yang lezat, tampilan yang menarik, dan kualitas yang terjaga, Dapur Umi siap menjadi pilihan kuliner yang menghadirkan kebahagiaan di setiap gigitan dan tegukan.
                    </p>
                    
                    <div class="text-center">
                        <a href="{{ route('menu') }}" class="btn btn-order text-white">
                            Lihat Menu Lengkap →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection