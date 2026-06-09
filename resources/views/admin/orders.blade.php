@extends('layouts.app')

@section('title', 'Kelola Pesanan')

@section('content')
<div class="container py-4">
    <h3 class="text-white mb-3">Data Pesanan</h3>

    <div class="table-responsive">
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pemesan</th>
                    <th>No. WhatsApp</th>
                    <th>Menu</th>
                    <th>Ukuran</th>
                    <th>Jumlah</th>
                    <th>Catatan</th>
                    <th>Status</th>
                    <th>Waktu Pesan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->nama_pemesan }}</td>
                    <td>{{ $order->no_wa }}</td>
                    <td>{{ $order->menu }}</td>
                    <td>{{ $order->ukuran ?: '-' }}</td>
                    <td>{{ $order->jumlah }}</td>
                    <td>{{ $order->catatan ?: '-' }}</td>
                    <td>
                        @php
                            $statusColors = [
                                'pending' => 'warning',
                                'confirmed' => 'info',
                                'completed' => 'success',
                                'cancelled' => 'danger'
                            ];
                            $statusText = [
                                'pending' => 'Pending',
                                'confirmed' => 'Dikonfirmasi',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan'
                            ];
                        @endphp
                        <span class="badge bg-{{ $statusColors[$order->status] }}">
                            {{ $statusText[$order->status] }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Ubah Status
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="pending">
                                        <button type="submit" class="dropdown-item">Pending</button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="dropdown-item">Dikonfirmasi</button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit" class="dropdown-item">Selesai</button>
                                    </form>
                                </li>
                                <li>
                                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="cancelled">
                                        <button type="submit" class="dropdown-item text-danger">Dibatalkan</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center text-white-50 py-5">
                        <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                        Belum ada pesanan masuk
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tombol Hubungi Pelanggan via WhatsApp -->
    @if(isset($orders) && count($orders) > 0)
    <div class="row mt-4">
        <div class="col-12">
            <div class="card bg-secondary border-0">
                <div class="card-body">
                    <h5 class="text-white mb-3">Hubungi Pelanggan</h5>
                    <div class="d-flex gap-2 flex-wrap">
                        @foreach($orders->where('status', 'pending')->take(5) as $order)
                            <a href="https://wa.me/{{ $order->no_wa }}" target="_blank" class="btn btn-success btn-sm">
                                <i class="fab fa-whatsapp"></i> {{ $order->nama_pemesan }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection