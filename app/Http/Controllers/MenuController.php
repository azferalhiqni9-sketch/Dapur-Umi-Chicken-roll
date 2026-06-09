<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // Tampil menu untuk user
    public function index()
    {
        $menus = Menu::orderBy('created_at', 'desc')->get();
        return view('menu', compact('menus'));
    }
    
    // Admin: Tampil kelola menu
    public function adminIndex()
    {
        $menus = Menu::orderBy('created_at', 'desc')->get();
        return view('admin.menu', compact('menus'));
    }
    
    // Admin: Tambah menu (DENGAN GAMBAR)
    public function store(Request $request)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:100',
            'harga_kecil' => 'nullable|numeric',
            'harga_besar' => 'nullable|numeric',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        $data = [
            'nama_menu' => $request->nama_menu,
            'harga_kecil' => $request->harga_kecil,
            'harga_besar' => $request->harga_besar,
            'deskripsi' => $request->deskripsi
        ];
        
        // Upload gambar
        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->move(public_path('images/menu'), $filename);
            $data['gambar'] = 'images/menu/' . $filename;
        }
        
        Menu::create($data);
        
        return redirect()->back()->with('success', 'Menu berhasil ditambahkan!');
    }
    
    // Admin: Update menu (DENGAN GAMBAR)
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_menu' => 'required|string|max:100',
            'harga_kecil' => 'nullable|numeric',
            'harga_besar' => 'nullable|numeric',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        $menu = Menu::findOrFail($id);
        
        $data = [
            'nama_menu' => $request->nama_menu,
            'harga_kecil' => $request->harga_kecil,
            'harga_besar' => $request->harga_besar,
            'deskripsi' => $request->deskripsi
        ];
        
        // Upload gambar baru
        if($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if($menu->gambar && file_exists(public_path($menu->gambar))) {
                unlink(public_path($menu->gambar));
            }
            
            $file = $request->file('gambar');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->move(public_path('images/menu'), $filename);
            $data['gambar'] = 'images/menu/' . $filename;
        }
        
        $menu->update($data);
        
        return redirect()->back()->with('success', 'Menu berhasil diupdate!');
    }
    
    // Admin: Hapus menu (HAPUS JUGA GAMBARNYA)
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        
        // Hapus file gambar jika ada
        if($menu->gambar && file_exists(public_path($menu->gambar))) {
            unlink(public_path($menu->gambar));
        }
        
        $menu->delete();
        
        return redirect()->back()->with('success', 'Menu berhasil dihapus!');
    }
}