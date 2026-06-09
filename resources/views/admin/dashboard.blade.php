@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-white">Dashboard Admin</h1>
        <div>
            <span class="text-white-50 me-3">Welcome, {{ Auth::user()->name }}</span>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-secondary text-white border-0">
                <div class="card-body text-center">
                    <h1 class="display-1 text-danger">{{ \App\Models\Menu::count() }}</h1>
                    <p class="h5">Total Menu</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-secondary text-white border-0">
                <div class="card-body text-center">
                    <h1 class="display-1 text-danger">{{ \App\Models\Order::count() }}</h1>
                    <p class="h5">Total Pesanan</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-secondary text-white border-0">
                <div class="card-body text-center">
                    <h1 class="display-1 text-danger">{{ \App\Models\Order::where('status', 'pending')->count() }}</h1>
                    <p class="h5">Pesanan Pending</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card bg-secondary border-0">
                <div class="card-header bg-black text-white">
                    <h5 class="mb-0">Menu Navigasi</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <a href="{{ route('admin.menu') }}" class="btn btn-danger">Kelola Menu</a>
                        <a href="{{ route('admin.orders') }}" class="btn btn-warning">Lihat Pesanan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection