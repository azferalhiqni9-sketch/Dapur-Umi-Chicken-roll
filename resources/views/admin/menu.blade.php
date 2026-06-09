@extends('layouts.app')

@section('title', 'Kelola Menu - Dapur Umi Chiro')

@section('content')
<style>
    .admin-header {
        background: linear-gradient(135deg, #D32F2F, #FF5722);
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
        color: white;
    }
    
    .form-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }
    
    .form-label {
        font-weight: 600;
        color: #D32F2F;
        margin-bottom: 8px;
    }
    
    .form-control, .form-select {
        border-radius: 10px;
        border: 1px solid #ddd;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #D32F2F;
        box-shadow: 0 0 0 0.2rem rgba(211, 47, 47, 0.25);
    }
    
    .btn-simpan {
        background: linear-gradient(135deg, #D32F2F, #FF5722);
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: bold;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }
    
    .btn-simpan:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(211, 47, 47, 0.4);
    }
    
    .table-menu {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    
    .table-menu thead {
        background: linear-gradient(135deg, #D32F2F, #FF5722);
        color: white;
    }
    
    .table-menu thead th {
        padding: 15px;
        font-weight: 600;
    }
    
    .table-menu tbody tr:hover {
        background: #FFF3E0;
    }
    
    .menu-img-preview {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 10px;
    }
    
    .btn-edit {
        background: #FFC107;
        color: #333;
        border: none;
        border-radius: 8px;
        padding: 5px 12px;
        margin-right: 5px;
    }
    
    .btn-hapus {
        background: #D32F2F;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 5px 12px;
    }
    
    .btn-edit:hover, .btn-hapus:hover {
        transform: translateY(-2px);
    }
    
    .preview-img {
        max-width: 100px;
        border-radius: 10px;
        margin-top: 10px;
        border: 2px solid #D32F2F;
    }
</style>

<div class="container py-5">
    <!-- Header -->
    <div class="admin-header text-center">
        <h1 class="mb-2">🍽️ Kelola Menu</h1>
        <p class="mb-0">Tambah, edit, atau hapus menu Dapur Umi Chiro</p>
    </div>
    
    <!-- Form Tambah Menu -->
    <div class="form-card">
        <h3 class="mb-4" style="color: #D32F2F;">📝 Tambah Menu Baru</h3>
        <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Menu</label>
                    <input type="text" name="nama_menu" class="form-control" placeholder="Contoh: Chiro" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Deskripsi</label>
                    <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi singkat menu">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga Kecil</label>
                    <input type="number" name="harga_kecil" class="form-control" placeholder="15000">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga Besar</label>
                    <input type="number" name="harga_besar" class="form-control" placeholder="20000">
                </div>
                
                <div class="col-md-12 mb-3">
                    <label class="form-label">📷 Foto Menu</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*" onchange="previewImage(this)">
                    <small class="text-muted">Format: JPG, PNG. Max: 2MB</small>
                    <img id="preview" class="preview-img" style="display: none;">
                </div>
            </div>
            
            <div class="text-center">
                <button type="submit" class="btn btn-simpan text-white">
                    💾 Simpan Menu
                </button>
            </div>
        </form>
    </div>
    
    <!-- Daftar Menu -->
    <h3 class="mb-4" style="color: #D32F2F;">📋 Daftar Menu</h3>
    
    <div class="table-responsive">
        <table class="table table-menu">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Menu</th>
                    <th>Deskripsi</th>
                    <th>Harga Kecil</th>
                    <th>Harga Besar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($menus as $menu)
                <tr>
                    <td>
                        @if($menu->gambar && file_exists(public_path($menu->gambar)))
                            <img src="{{ asset($menu->gambar) }}" class="menu-img-preview">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td class="fw-bold">{{ $menu->nama_menu }}</td>
                    <td>{{ Str::limit($menu->deskripsi, 30) ?: '-' }}</td>
                    <td>Rp {{ number_format($menu->harga_kecil,0,',','.') ?: '-' }}</td>
                    <td>Rp {{ number_format($menu->harga_besar,0,',','.') ?: '-' }}</td>
                    <td>
                        <button class="btn-edit" onclick="editMenu({{ $menu->toJson() }})">
                            ✏️ Edit
                        </button>
                        
                        <form action="{{ route('admin.menu.destroy', $menu->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus" onclick="return confirm('Yakin hapus {{ $menu->nama_menu }}?')">
                                🗑️ Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">Belum ada menu. Silakan tambah menu di atas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Edit Menu -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 20px;">
            <div class="modal-header" style="background: linear-gradient(135deg, #D32F2F, #FF5722); color: white;">
                <h5 class="modal-title">✏️ Edit Menu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Menu</label>
                            <input type="text" name="nama_menu" id="edit_nama_menu" class="form-control" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Deskripsi</label>
                            <input type="text" name="deskripsi" id="edit_deskripsi" class="form-control">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga Kecil</label>
                            <input type="number" name="harga_kecil" id="edit_harga_kecil" class="form-control">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga Besar</label>
                            <input type="number" name="harga_besar" id="edit_harga_besar" class="form-control">
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Foto Menu Saat Ini</label><br>
                            <img id="edit_gambar_preview" class="preview-img">
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Ganti Foto (opsional)</label>
                            <input type="file" name="gambar" class="form-control" accept="image/*" onchange="previewEditImage(this)">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Update Menu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(input) {
        var preview = document.getElementById('preview');
        if(input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.style.display = 'block';
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    function previewEditImage(input) {
        var preview = document.getElementById('edit_gambar_preview');
        if(input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    function editMenu(menu) {
        document.getElementById('edit_id').value = menu.id;
        document.getElementById('edit_nama_menu').value = menu.nama_menu;
        document.getElementById('edit_deskripsi').value = menu.deskripsi || '';
        document.getElementById('edit_harga_kecil').value = menu.harga_kecil || '';
        document.getElementById('edit_harga_besar').value = menu.harga_besar || '';
        
        var gambarPreview = document.getElementById('edit_gambar_preview');
        if(menu.gambar) {
            gambarPreview.src = "{{ asset('') }}" + menu.gambar;
            gambarPreview.style.display = 'block';
        } else {
            gambarPreview.style.display = 'none';
        }
        
        // PERBAIKAN DI SINI
        var updateUrl = "{{ route('admin.menu.update', ['id' => '__ID__']) }}";
        updateUrl = updateUrl.replace('__ID__', menu.id);
        document.getElementById('editForm').action = updateUrl;
        
        var modal = new bootstrap.Modal(document.getElementById('editModal'));
        modal.show();
    }
</script>
@endsection