<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Menampilkan form pemesanan
    public function create()
    {
        $menus = \App\Models\Menu::all();
        return view('pesan', compact('menus'));
    }
    
    // Menyimpan pesanan dan redirect ke WhatsApp
    public function store(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required|string|max:100',
            'no_wa' => 'required|string|max:20',
            'menu' => 'required|string',
            'jumlah' => 'required|integer|min:1',
            'ukuran' => 'nullable|string',
            'catatan' => 'nullable|string'
        ]);
        
        // Simpan ke database
        $order = Order::create([
            'nama_pemesan' => $request->nama_pemesan,
            'no_wa' => $request->no_wa,
            'menu' => $request->menu,
            'ukuran' => $request->ukuran,
            'jumlah' => $request->jumlah,
            'catatan' => $request->catatan,
            'status' => 'pending'
        ]);
        
        // Hitung total harga (contoh sederhana)
        $harga = $this->getHargaMenu($request->menu, $request->ukuran);
        $total = $harga * $request->jumlah;
        
        // Format pesan WhatsApp
        $message = "*🍽️ PESANAN DAPUR UMI CHIRO*%0A%0A" .
                   "━━━━━━━━━━━━━━━━━━━━%0A" .
                   "*📋 DETAIL PESANAN*%0A" .
                   "━━━━━━━━━━━━━━━━━━━━%0A" .
                   "👤 *Nama:* " . $request->nama_pemesan . "%0A" .
                   "📞 *No. WA:* " . $request->no_wa . "%0A" .
                   "🍔 *Menu:* " . $request->menu . "%0A" .
                   "📏 *Ukuran:* " . ($request->ukuran ?: '-') . "%0A" .
                   "🔢 *Jumlah:* " . $request->jumlah . " porsi%0A" .
                   "💰 *Total:* Rp " . number_format($total, 0, ',', '.') . "%0A" .
                   "📝 *Catatan:* " . ($request->catatan ?: '-') . "%0A%0A" .
                   "━━━━━━━━━━━━━━━━━━━━%0A" .
                   "✨ Terima kasih sudah memesan!%0A" .
                   "Kami akan segera memproses pesanan Anda.%0A" .
                   "━━━━━━━━━━━━━━━━━━━━";
        
        // Ganti dengan nomor WhatsApp bisnis ANDA
        $whatsappNumber = "6281234567890"; // Ganti dengan nomor asli
        
        return redirect()->away("https://wa.me/$whatsappNumber?text=$message");
    }
    
    // Admin: Lihat semua pesanan
    public function adminIndex()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('admin.orders', compact('orders'));
    }
    
    // Admin: Update status pesanan
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);
        
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'Status pesanan berhasil diupdate!');
    }
    
    // Helper: Ambil harga menu
    private function getHargaMenu($menuName, $ukuran)
    {
        $menu = \App\Models\Menu::where('nama_menu', $menuName)->first();
        if ($menu) {
            if ($ukuran == 'Besar' && $menu->harga_besar) {
                return $menu->harga_besar;
            }
            return $menu->harga_kecil ?: 15000;
        }
        return 15000; // Harga default
    }
}