@extends('layouts.app')

@section('title', 'Kontak Kami - Dapur Umi Chiro')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Kontak Kami</h1>
    <p class="text-center text-white-50 mb-5">"Punya pertanyaan atau ingin pesan? Kami siap melayani dengan sepenuh hati."</p>

    <div class="row">
        <div class="col-md-5">
            <div class="card bg-secondary border-0 mb-4">
                <div class="card-body">
                    <h4 class="text-danger"><i class="fas fa-map-marker-alt me-2"></i> Alamat</h4>
                    <p>Jl. Lkr. Utara<br>Tasikmalaya, West Java</p>
                    
                    <h4 class="text-danger mt-4"><i class="fas fa-clock me-2"></i> Jam Kerja</h4>
                    <p>Senin – Sabtu: 16.00 - 22.00 | Minggu: 06.00 - 11.30</p>
                    
                    <h4 class="text-danger mt-4"><i class="fas fa-envelope me-2"></i> Email</h4>
                    <p>dapurumichiro@gmail.com</p>
                    
                    <h4 class="text-danger mt-4"><i class="fas fa-phone me-2"></i> Telepon</h4>
                    <p>+62 895-6345-86948</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-7">
            <div class="card bg-secondary border-0">
                <div class="card-body">
                    <h4 class="card-title text-danger"><i class="fas fa-paper-plane me-2"></i> Kirim Pesan</h4>
                    
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" id="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No. WhatsApp</label>
                        <input type="tel" id="nowa" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pesan</label>
                        <textarea id="pesan" rows="4" class="form-control" required></textarea>
                    </div>
                    <button type="button" class="btn btn-danger w-100" onclick="kirimWA()">
                        <i class="fab fa-whatsapp me-2"></i>Kirim ke WhatsApp
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-5">
        <div class="col-12">
            <div class="card bg-secondary border-0">
                <div class="card-body text-center">
                    <h4 class="text-danger mb-3">Ikuti Kami</h4>
                    <div class="d-flex justify-content-center gap-4">
                        <a href="#" class="text-white fs-3"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="text-white fs-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white fs-3"><i class="fab fa-tiktok"></i></a>
                        <a href="#" class="text-white fs-3"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function kirimWA() {
    const nama  = document.getElementById('nama').value.trim();
    const nowa  = document.getElementById('nowa').value.trim();
    const pesan = document.getElementById('pesan').value.trim();

    if (!nama || !nowa || !pesan) {
        alert('Mohon isi semua kolom terlebih dahulu!');
        return;
    }

    const nomorToko = '6289563458648';

    const teks = `Halo, saya *${nama}*\nNo. WA saya: ${nowa}\n\n${pesan}`;
    const url  = `https://wa.me/${nomorToko}?text=${encodeURIComponent(teks)}`;

    window.open(url, '_blank');
}
</script>

@endsection