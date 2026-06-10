@extends('layouts.app')

@section('title', 'Menu - Dapur Umi Chiro')

@section('content')
<style>
    .menu-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
        border-radius: 15px;
    }


body, html {
    margin: 0;
    padding: 0;
    background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('img/menu.png') }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed; /* biar background tetap saat di-scroll */
    min-height: 100vh;
}
    
    .menu-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.3);
    }
    
    .menu-img {
        height: 200px;
        width: 100%;
        object-fit: cover;
        border-radius: 15px 15px 0 0;
    }
</style>

<div class="container py-5">
    <h1 class="text-center mb-3" style="color: #D32F2F;">🍽️ Menu Kami</h1>
    <p class="text-center text-white-50 mb-5">Nikmati beragam pilihan menu favorit yang diracik dengan bahan berkualitas dan cita rasa istimewa.</p>

    <div class="row g-4">
        @forelse($menus as $menu)
        <div class="col-md-4">
            <div class="card bg-secondary text-white h-100 border-0 menu-card">
                <!-- TAMPILKAN GAMBAR -->
            <!-- TAMPILKAN GAMBAR - VERSI BENAR -->
                @if($menu->gambar && file_exists(public_path('images/menu/' . $menu->gambar)))
                    <img src="{{ asset('images/Hotang/' . $menu->gambar) }}" 
                        alt="{{ $menu->nama_menu }}" 
                        class="menu-img">
                @else
                    <img src="https://via.placeholder.com/400x200?text={{ urlencode($menu->nama_menu) }}" 
                        alt="{{ $menu->nama_menu }}" 
                        class="menu-img">
                @endif
                
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <h4 class="card-title text-danger mb-0">{{ $menu->nama_menu }}</h4>
                        <button onclick="openOrderModal('{{ $menu->nama_menu }}')" class="btn btn-sm btn-danger">
                            🛒 Pesan
                        </button>
                    </div>
                    <p class="card-text">{{ $menu->deskripsi ?: 'Menu lezat dari Dapur Umi Chiro' }}</p>
                    <div class="mt-3">
                        @if($menu->harga_kecil && $menu->harga_besar)
                            <span class="badge bg-success p-2">
                                Rp {{ number_format($menu->harga_kecil,0,',','.') }} - Rp {{ number_format($menu->harga_besar,0,',','.') }}
                            </span>
                        @elseif($menu->harga_kecil)
                            <span class="badge bg-success p-2">
                                Rp {{ number_format($menu->harga_kecil,0,',','.') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <p class="text-white-50">Belum ada menu. Silakan login sebagai admin untuk menambah menu.</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Modal Pemesanan -->
<div class="modal fade" id="orderModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-secondary text-white">
            <div class="modal-header">
                <h5 class="modal-title">📝 Pesan Menu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('pesan.proses') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="menu" id="orderMenu">
                    <div class="mb-3">
                        <label class="form-label">👤 Nama Pemesan</label>
                        <input type="text" name="nama_pemesan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">📱 No. WhatsApp</label>
                        <input type="tel" name="no_wa" class="form-control" placeholder="08xxxxxxxxxx" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">📏 Ukuran</label>
                        <select name="ukuran" class="form-control">
                            <option value="">Pilih Ukuran</option>
                            <option value="Kecil">Kecil</option>
                            <option value="Besar">Besar</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">🔢 Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" value="1" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">📝 Catatan (opsional)</label>
                        <textarea name="catatan" class="form-control" rows="2" placeholder="Level pedas, request khusus..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">📱 Pesan via WhatsApp</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openOrderModal(menuName) {
        document.getElementById('orderMenu').value = menuName;
        var modal = new bootstrap.Modal(document.getElementById('orderModal'));
        modal.show();
    }
</script>
@endsection